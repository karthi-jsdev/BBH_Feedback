<?php
	interface ITreeManager 
	{
		public function insertElement($name, $ownerEl, $slave);
		public function getElementList($ownerEl, $pageName);
		public function updateElementName($name, $elementId, $ownerEl);
		public function deleteElement($elementId, &$index = 0, $ownerEl);
		public function changeOrder($elementId, $oldOwnerEl, $destOwnerEl, $destPosition);
		public function getRootId();
	}
?>

