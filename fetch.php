<?php

$connect = mysqli_connect("localhost","root","","ajaxmultipledatainsertandfetchwithaddingorremovinginputfield");

$output = '';
$query = "SELECT * FROM `item`";
$result = mysqli_query($connect, $query);
$output .= '
<br/>
<div class="shadow-lg p-3 mb-5 bg-white rounded">
  <span class="navbar-brand"><div class="shadow-lg p-3 mb-5 bg-white rounded">Item</div></span>
</br>
		<table class="table table-bordered table-striped">
			<tr>
				<th width="30%">Item Name</th>
				<th width="10%">Item Code</th>
				<th width="45%">Description</th>
				<th width="10%">Price</th>
			</tr>
';
while ($row = mysqli_fetch_array($result)) {
	$output .= '
	<tr>
	<td>'.$row["item_name"].'</td>
	<td>'.$row["item_code"].'</td>
	<td>'.$row["item_description"].'</td>
	<td>'.$row["item_price"].'</td>
	</tr>
	';
}
$output .= '</table></div>';
echo $output;
?>