<?php
error_reporting(0);
require('./db_config.php');
// Set Database Config
require('./class_datatables_crud.php');
// CRUD Methods: "GET", "PUT", "POST" & "DELETE"
$conn = new Class_DataTables_CRUD();
$conn->getConnection();
// Get POST Primary Key
$item_id = isset( $_POST['item_id'] ) ? filter_var( $_POST['item_id'], FILTER_SANITIZE_STRING ) : '';

if( $item_id != null ) {
	$output = array();
	$result = $conn->get_method( "items", "item_id", $item_id );
	$rows = json_decode($result, true );

	foreach( $rows as $row ) {

		$output["item_id"] 		= $row["item_id"];
		$output["item_image"] = $image;
		$output["item_name"] 	= $row["item_name"];
		$output["item_price"] = $row["item_price"];
		$output["cat_id"] 		= $row["cat_id"];
		$output["item_stock"] = $row["item_stock"];
		$output["item_desc"] 	= $row["item_desc"];
		if ( $row["item_image"] != null ) {
				$output["item_image"] = '<img src="./upload/' . $row["item_image"] . '" class="img-thumbnail" width="300" height="500" />';
		} else {
				$output["item_image"] = '<img src="./upload/nophoto.jpg" class="img-thumbnail" width="300" height="500" />';
		}

	}
	echo json_encode($output);
}
