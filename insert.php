<?php

$connect = mysqli_connect("localhost","root","","ajaxmultipledatainsertandfetchwithaddingorremovinginputfield");

if (isset($_POST["item_name"])) {
	 $item_name = $_POST["item_name"];
	 $item_code = $_POST["item_code"];
	 $item_desc = $_POST["item_desc"];
	 $item_price = $_POST["item_price"];

	// $item_name = array("Peter", "Joe", "Glenn", "Cleveland");
	// $item_code = array("Peter", "Joe", "Glenn", "Cleveland");
	// $item_desc = array("Peter", "Joe", "Glenn", "Cleveland");
	// $item_price = array("Peter", "Joe", "Glenn", "Cleveland");

	$query = '';

	for ($count=0; $count < count($item_name); $count++) { 
		$item_name_data =  $item_name[$count];
		$item_code_data =  $item_code[$count];
		$item_desc_data =  $item_desc[$count];
		$item_price_data = $item_price[$count];

		if ($item_name_data != '' && $item_code_data != '' && $item_desc_data != '' && $item_price_data != '') {
			
			$query .= 'INSERT INTO `item` (`item_name`, `item_code`, `item_description`, `item_price`) VALUES ("'.$item_name_data.'","'.$item_code_data.'" ,"'.$item_desc_data.'" ,"'.$item_price_data.'");';
		}
	}
		mysqli_multi_query($connect, $query);	
	
}
?>