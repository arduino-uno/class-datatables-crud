<?php
error_reporting(0);
require('./db_config.php');
// Set Database Config
require('./class_datatables_crud.php');
// All $_POST Variables
$method = isset( $_POST['method'] ) ? filter_var( $_POST['method'], FILTER_SANITIZE_STRING ) : '';
// Get POST Primary Key
$item_id = isset( $_POST['item_id'] ) ? filter_var( $_POST['item_id'], FILTER_SANITIZE_STRING ) : '';
$item_cat = isset( $_POST['item_cat'] ) ? filter_var( $_POST['item_cat'], FILTER_SANITIZE_STRING ) : '';
$item_name = isset( $_POST['item_name'] ) ? filter_var( $_POST['item_name'], FILTER_SANITIZE_STRING ) : '';
$item_price = isset( $_POST['item_price'] ) ? filter_var( $_POST['item_price'], FILTER_SANITIZE_STRING ) : '';
$item_stock = isset( $_POST['item_stock'] ) ? filter_var( $_POST['item_stock'], FILTER_SANITIZE_STRING ) : '';
$item_image  = empty( $_FILES['item_image']['name'] ) ? 'no_image.jpg' : upload_image();
$item_desc = isset( $_POST['item_desc'] ) ? filter_var( $_POST['item_desc'], FILTER_SANITIZE_STRING ) : '';
// CRUD Methods: "GET", "PUT", "POST" & "DELETE"
$conn = new Class_DataTables_CRUD();
$conn->getConnection();

if ( $method == "Add" ) {

	// set a new ID ( primari key )
	$new_item_id = $conn->get_newid( "items", "item_id", "FD" );
	// set Array new Data
	$arr_data = Array(
			"item_id"				=> $new_item_id,
			"cat_id" 				=> $item_cat,
			"item_name" 		=> $item_name,
			"item_price" 		=> $item_price,
			"item_stock" 		=> $item_stock,
			"item_image" 		=> $item_image,
			"item_desc" 		=> $item_desc
		);
	// Call insert data function
	$result = $conn->post_method( "items", $arr_data );
	echo $result;

} elseif ( $method == "Edit" ) {

	// set Array new Data
	$arr_data = Array(
			"item_id"				=> $item_id,
			"cat_id" 				=> $item_cat,
			"item_name" 		=> $item_name,
			"item_price" 		=> $item_price,
			"item_stock" 		=> $item_stock,
			"item_image" 		=> $item_image,
			"item_desc" 		=> $item_desc
		);
	// Call update data function
	$result = $conn->put_method( "items", $arr_data, "item_id", $item_id );
	echo $result;

} else {
	// Call update data function
	$result = $conn->delete_method( "items", "item_id", $item_id );
	if ( $item_image != 'no_image.jpg' ) unlink( './upload/' . $item_image );
	echo $result;
}

function upload_image() {
	$extension = explode( '.', $_FILES['item_image']['name'] );
	$new_name = rand() . '.' . $extension[1];
	$destination = './upload/' . $new_name;
	move_uploaded_file( $_FILES['item_image']['tmp_name'], $destination );
	return $new_name;
}
