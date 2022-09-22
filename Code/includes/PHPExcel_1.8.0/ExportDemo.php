<?php
	set_time_limit(100);
	// Include PHPExcel
	require_once('Classes/PHPExcel.php');
	require_once('Classes/PHPExcel/IOFactory.php');
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	$styleArray = array(
	'borders' => array(
	'allborders' => array(
		'style' => PHPExcel_Style_Border::BORDER_THIN,
		'color' => array('argb' => '000000'),
	),),);
	$TableHeaderStyle = array(
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => '000000'),
		'size'  => 10,
		'name'  => 'Verdana'
	));
	
	$TableNoData = array(
	'font'  => array(
		'bold'  => true,
		'color' => array('rgb' => 'FF0000'),
		'size'  => 10,
		'name'  => 'Verdana'
	),
	'alignment' => array(
		'wrap'       => true,
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
	));
	
	//Removes all the files of the folder
	array_map('unlink', glob("Export/*"));

	// Set document properties
	$objPHPExcel->getProperties()->setCreator("Pentamine Technologies Pvt. Ltd.")
	->setLastModifiedBy("Pentamine Technologies Pvt. Ltd.")
	->setTitle("Report")
	->setSubject("Report")
	->setDescription("report of BBHFeedback")
	->setKeywords("BBHFeedback")
	->setCategory("Reports");
	$Sheet = -1;

	// 
	$Sheet++;
	$objPHPExcel->createSheet($Sheet);
	$objPHPExcel->getSheet($Sheet)->setTitle("Report");
	$objPHPExcel->setActiveSheetIndex($Sheet)
	->setCellValue('A6', 'S.No.')
	->setCellValue('B6', 'Vehicle(Id)')
	->setCellValue('C6', 'Location (Lat,Lon)')
	->setCellValue('D6', 'Location Time')
	->setCellValue('E6', 'Speed')
	->setCellValue('F6', 'Battery')
	->setCellValue('G6', 'SatInCom')
	->setCellValue('H6', 'Log Time')
	->setCellValue('I6', 'Error Code')
	->setCellValue('J6', 'Last Ping')->getStyle('A6:J6')->applyFromArray($TableHeaderStyle);
	$i=0;
	//$Devices = Select_Devices_By_DeviceIds();
	SetHeader($Sheet, $_SESSION['Filter']['Module']." Report ".date("d-M-Y"), "Total ".$_SESSION['Filter']['Module']." Logs : ".mysqli_num_rows($Devices));
	
	while($Device = mysqli_fetch_array($Devices))
	{
		$objPHPExcel->setActiveSheetIndex($Sheet)
		->setCellValue('A'.(6+(++$i)), $i)
		->setCellValue('B'.(6+$i), $Device['deviceName']." (".$Device['id'].")")
		->setCellValue('C'.(6+$i), "($Device[latitude], $Device[longitude])")
		->setCellValue('D'.(6+$i), date('h:i:s a d/m/Y', strtotime($Device['trackingDateTime'])))
		->setCellValue('E'.(6+$i), $Device['speed'])
		->setCellValue('F'.(6+$i), $Device['battery'])
		->setCellValue('G'.(6+$i), $Device['satiliteInCom'])
		->setCellValue('H'.(6+$i), date('h:i:s a d/m/Y', strtotime($Device['dateTime'])))
		->setCellValue('I'.(6+$i), $Device['errorCode'])
		->setCellValue('J'.(6+$i), date('h:i:s a d/m/Y', strtotime($Device['LastPing'])));
	}
	if(!$i)
		$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A7', "No Data Found!")->mergeCells('A7:J7')->getStyle('A7:J7')->applyFromArray($TableNoData);
	$objPHPExcel->setActiveSheetIndex($Sheet)->getStyle('A6:J'.(7+$i))->applyFromArray($styleArray);
	
	//Streatch column width based on the content
	for($col = 'A'; $col !== 'K'; $col++)
		$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
	
	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$objPHPExcel->setActiveSheetIndex(0);
	// Save Excel 2007 file
	$callStartTime = microtime(true);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	//$objWriter->save(str_replace('Export/'.$_POST['Module'].'.php', '.xlsx', __FILE__));
	
	
	$objWriter->save("Export/".$_SESSION['Filter']['Module']." ".date("Y_m_d").".xlsx");
	$callEndTime = microtime(true);
	$callTime = $callEndTime - $callStartTime;
	echo $_SESSION['Filter']['Module']." ".date("Y_m_d").".xlsx";
	/*
	echo date('H:i:s') , " Write to Excel2007 format" , EOL;
	echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
	echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
	// Echo memory usage
	echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

	// Echo memory peak usage
	echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

	// Echo done
	echo date('H:i:s') , " Done writing files" , EOL;
	echo 'File has been created in ' , getcwd() , EOL;*/
// Sheet Header------------------------------------------------------------------------------
	function SetHeader($Title, $SubTitle)
	{
		global $objPHPExcel, $Sheet;
		$objPHPExcel->setActiveSheetIndex($Sheet)->mergeCells('A1:E2');
		$objPHPExcel->setActiveSheetIndex($Sheet)->mergeCells('F1:J2')->getStyle('F1:J2')->getFont()->setSize(16)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($Sheet)->mergeCells('A3:J4')->getStyle('A3:J4')->getFont()->setSize(16)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A3', $_SESSION[$_SESSION['Prefix'].'organizationName']." : ".$Title);
		$objPHPExcel->setActiveSheetIndex($Sheet)->mergeCells('A5:J5')->getStyle('A5:C5')->getFont()->setSize(14)->setBold(true);
		$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('A5', $SubTitle);
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$objDrawing->setCoordinates('A1');
		$objDrawing->setPath('logo.png');
		$objDrawing->setHeight(36);
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		
		if($_SESSION[$_SESSION['Prefix'].'distributorLogo'])
		{
			$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
			$objDrawing->setImageResource((imagecreatefromstring($_SESSION[$_SESSION['Prefix'].'distributorLogo'])));
			$objDrawing->setCoordinates('F1');
			$objDrawing->setHeight(40);
			$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
		}
		else
			$objPHPExcel->setActiveSheetIndex($Sheet)->setCellValue('F1', $_SESSION[$_SESSION['Prefix'].'distributorName']);
	}
?>