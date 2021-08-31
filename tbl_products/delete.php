<?php
error_reporting(0);
require('./db_config.php');
// Set Database Config
require('./class_datatables_crud.php');

if(isset($_POST["user_id"]))
{
	$image = get_image_name($_POST["user_id"]);
	if($image != '')
	{
		unlink("upload/" . $image);
	}
	$statement = $connection->prepare(
		"DELETE FROM users WHERE id = :id"
	);
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);

	if(!empty($result))
	{
		echo 'Data Deleted';
	}
}
