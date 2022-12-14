<?php
	require_once('ITreeManager.php');
	class DBTreeManager implements ITreeManager
	{
		private $db;
		public function __construct($dbc)
		{
			$this->db = $dbc;
		}

		public function insertElement($name, $ownerEl, $slave)
		{
			$ownerEl = (int) $ownerEl;
			$sql = sprintf('INSERT INTO questions(group_id, name, position, ownerEl, slave, status)
			SELECT '.$_SESSION['group_id'].', \'%s\', ifnull(max(el.position)+1, 0), %d, %d, 1 FROM questions el 
			WHERE el.ownerEl = %d ', $name , $ownerEl, $slave, $ownerEl);
			$out = FAILED;
			if($this->db->query($sql) == true)
			{
				$out = '({ "elementId":"'.$this->db->lastInsertId().'", "elementName":"'.$name.'", "slave":"'.$slave.'"})';
				mysqli_query("ALTER TABLE feedbacks_".$_SESSION['group_id']." ADD COLUMN `".$this->db->lastInsertId()."` int(11) NOT NULL");
			}
			$this->db->query('UPDATE dynamic SET `update`='.rand());
			
			$Last_Row = mysqli_fetch_array(mysqli_query("SELECT Id FROM questions ORDER BY Id DESC LIMIT 1"));
			mysqli_query("UPDATE questions SET module='".str_replace(" ", "_", $name)."' WHERE Id=".$Last_Row['Id']);
			
			return $out;	
		}

		public function getElementList($ownerEl, $pageName)
		{
			if($ownerEl == null)
				$ownerEl = 0;
			else
				$ownerEl = (int) $ownerEl;
			
			$sql = sprintf("SELECT Id, name, slave, status FROM questions WHERE group_id=".$_SESSION['group_id']." && ownerEl=%d ORDER BY position ", $ownerEl);
			$str = FAILED;
			$result = $this->db->query($sql);
			if ($result !== false)
			{
				$str = NULL;
				while ($row = $this->db->fetchObject($result))
				{
					$supp = NULL;
					if($row->slave == 0)
					{
						$supp = "<ul class='ajax'><li>{url:".$pageName."?action=getElementList&ownerEl=".$row->Id."}</li></ul>";
					}
					if($row->status == 1)
						$status = "checked";
					else		
						$status = "";
					//Checkbox
					$UI = "";
					if($_SESSION['TreeCheckBox'])
						$UI = "<input type='checkbox' onchange='toggleCheckbox($row->Id, this.checked, $row->slave);' name='Module' id='R".$row->Id."' value='".$row->Id."' $status><span>".$row->name."</span></input>";
					else
						$UI = "<span>".$row->name."</span>";
					$str .= "<li class='text' id='".$row->Id."'>".$UI.$supp."</li>";
				}
			}
			return $str;
		}

		public function updateElementName($name, $elementId, $ownerEl)
		{
			$elementId = (int) $elementId;
			$sql = sprintf('UPDATE questions SET name = \'%s\' WHERE  Id = %d ', $name, $elementId);
			$out = FAILED;					
			if($this->db->query($sql) == true)
				$out = '({"elementName":"'.$name.'", "elementId":"'.$elementId.'"})';
			$this->db->query('UPDATE dynamic SET `update`='.rand());
			mysqli_query("UPDATE questions SET module='".str_replace(" ", "_", $name)."' WHERE Id=".$elementId);
			return $out;
		}

		public function deleteElement($elementId, &$index = 0, $ownerEl)
		{
			$elementId = (int) $elementId;
			$sql = sprintf('SELECT Id, slave, position, ownerEl FROM questions WHERE ownerEl = %d ', $elementId);
			$row = NULL;
			$index++;
			if($result = $this->db->query($sql))
			{
				while($row = $this->db->fetchObject($result))
				{
					// if element type is not slave, there can be childs belonging to that master
					if ($row->slave == "0")
					{
						// recursive operation, to reach the deepest element
						$this->deleteElement($row->Id, $index);
					}
				}
			}
			$index--;

			// only update the elements' position on the same level of our first element
			if ($index == 0)
			{
				$sql = sprintf('SELECT position, ownerEl FROM questions WHERE Id = %d', $elementId);

				if($result = $this->db->query($sql))
				{
					if($row = $this->db->fetchObject($result))
					{
						$sql = sprintf('UPDATE questions SET position = position-1 WHERE ownerEl = %d AND position > %d', $row->ownerEl, $row->position);
						$this->db->query($sql);
					}
				}
			}

			// start to delete it from bottom to top
			$sql = sprintf('DELETE FROM questions WHERE ownerEl = %d OR Id = %d ',  $elementId, $elementId);
			$out = FAILED;
			if($this->db->query($sql) == true)
				$out = SUCCESS;
			$this->db->query('UPDATE dynamic SET `update`='.rand());
			return $out;     
		}

		public function changeOrder($elementId, $oldOwnerEl, $destOwnerEl, $destPosition)
		{
			$sql = sprintf('SELECT ownerEl, position FROM questions WHERE Id=%d LIMIT 1', $elementId);
			$out = FAILED;					
			if($result = $this->db->query($sql))
			{
				if($element = $this->db->fetchObject($result))
				{
					$sql1 = sprintf('UPDATE questions SET position = position-1 WHERE position>%d AND ownerEl = %d ',
					$element->position, $element->ownerEl);

					$sql2 = sprintf('UPDATE questions SET position = position + 1 WHERE position >= %d AND ownerEl = %d ', $destPosition, $destOwnerEl);
					$sql3 = sprintf('UPDATE questions SET position = %d , ownerEl = %d WHERE Id = %d ', $destPosition, $destOwnerEl, $elementId);

					if($this->db->query($sql1) && $this->db->query($sql2) && $this->db->query($sql3))
						$out = '({"oldElementId":"'.$elementId.'", "elementId":"'. $elementId .'"})';
				}
			}
			return $out;				
		}
		
		public function getRootId()
		{
			return 0;
		}
	}
?>