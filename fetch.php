<?php
error_reporting(0);
require('./db_config.php');
// Set Database Config
require('./class_datatables_crud.php');
// CRUD Methods: "GET", "PUT", "POST" & "DELETE"
$conn = new Class_DataTables_CRUD();
$conn->getConnection();

$output = array();
$rows = Array();
$query = "SELECT * FROM items ";

  if ( isset( $_POST["search"]["value"] ) ) {
  	$query .= 'WHERE item_name LIKE "%'.$_POST["search"]["value"].'%" ';
  	$query .= 'OR item_desc LIKE "%'.$_POST["search"]["value"].'%" ';
  }

  if ( isset( $_POST["order"] ) ) {
  	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
  } else {
  	$query .= 'ORDER BY item_id ASC';
  }

  if ( isset( $_POST["length"] ) && $_POST["length"] != -1 ) {
  	$query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
  }

$result = $conn->get_sql_exec( $query );
$rows = json_decode( $result, true );

	foreach( $rows as $row ) {

		if ( $row["item_image"] != null ) {
			$image = '<img src="./upload/' . $row["item_image"] . '" class="img-thumbnail" width="50" height="35" />';
		} else {
			$image = '<img src="./upload/nophoto.jpg" class="img-thumbnail" width="50" height="35" />';
		}

		$sub_array = array();
		$sub_array[] = '';
		$sub_array[] = $row["item_id"];
		$sub_array[] = $image;
		$sub_array[] = $row["item_name"];
		$sub_array[] = $row["item_price"];
		$sub_array[] = $row["item_stock"];
		$sub_array[] = $row["item_desc"];

		$data[] = $sub_array;

	}

  $filtered_rows = count( $rows );
  $rows_cnt = $conn->get_total_all_records( "items" );

	$output = array(
		"draw"						=>	( isset( $_POST["draw"] ) ? intval( $_POST["draw"] ) : 0 ),
		"recordsTotal"		=> 	$filtered_rows,
		"recordsFiltered"	=>	$rows_cnt,
		"data"						=>	$data
	);

  echo json_encode( $output, JSON_PRETTY_PRINT );
