# class-datatables-crud
Rest API CRUD ( Create, Read, Update &amp; Delete ) for DataTables ( Table plug-in for jQuery )

#### <u>Examples</u>:
```php
// CRUD Methods: "GET", "PUT", "POST" & "DELETE"
$rows = $conn->get_method( "items", "", "" );
echo $rows;

// CRUD Methods: "GET"
$rows_cnt = $conn->get_total_all_records( "items" );
echo $rows_cnt;

// CRUD Methods: "Custom GET"
$rows = $conn->get_sql_exec( "select * from items where item_id = 'FD-001'" );
echo $rows;

// Create new unique ID
$new_order_id = $conn->get_newid( "orders", "order_id", "PO" );
echo $new_order_id;

// set Array new Data
$arr_data = Array(
		"user_login" 		=> "nath4n24",
		"user_fullname" 	=> "Agah Nata",
		"user_email" 		=> "admin@foodia.com",
		"user_pass" 		=> "21232f297a57a5a743894a0e4a801fc3" );

// Call insert data function
$result = $conn->post_method( 'users', $arr_data );
echo $result;
		
// Call update data function
$result = $conn->put_method( 'users', $arr_data, 'user_id', 'ID-001' );
echo $result;

// Call delete data function
$result = $conn->delete_method( "items", "item_id", $item_id );
if ( $item_image != 'no_image.jpg' ) unlink( './upload/' . $item_image );
echo $result;
```
<span style="color:'#c0c0c0'">YouTube Video: https://youtu.be/MbdAso4pv6M</span>
