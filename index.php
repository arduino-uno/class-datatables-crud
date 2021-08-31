<?php
error_reporting(0);
require('./db_config.php');
// Set Database Config
require('./class_datatables_crud.php');
// CRUD Methods: "GET", "PUT", "POST" & "DELETE"
$conn = new Class_DataTables_CRUD();
$conn->getConnection();
// SQL string for Category
$query = "SELECT cat_id, cat_name FROM category";
$rows = $conn->get_sql_exec( $query );
$rows = json_decode( $rows, true );
?>
<html>
	<head>
		<title>PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" />
		<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="//cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap.min.css" />
		<script src="//cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
		<script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
		<script src="//cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

		<link rel="stylesheet" href="//cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" />
		<script src="//cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
		<style>
			body
			{
				margin:0;
				padding:0;
				background-color:#f1f1f1;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
		<div class="container box">
			<h1 align="center">PHP PDO Ajax CRUD with Data Tables and Bootstrap Modals</h1>
			<br />
			<div class="table-responsive" style="overflow-x: hidden;">
				<br />
				<div id="buttons" class="btn-group pull-right" align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#itemModal" class="btn btn-info">Add</button>
					<button type="button" id="update_button" class="btn btn-warning">Update</button>
					<button type="button" id="delete_button" class="btn btn-danger">Delete</button>
				</div>
				<p>&nbsp;</p>
				<table id="item_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="40" style="text-align: center;">#</th>
							<th width="40" style="text-align: center;">ID</th>
							<th width="60">Image</th>
							<th width="150">Food Name</th>
							<th>Item Price</th>
							<th>Stock</th>
							<th>Description</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</body>
</html>
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
	<form method="post" id="item_form" action="./actions.php" enctype="multipart/form-data">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Item</h4>
				</div>
				<div class="modal-body">
				    <div class="row">
				      <div class="col-xs-6">
								<label>Item Name</label>
								<input type="hidden" name="item_id" id="item_id" />
								<input type="text" name="item_name" id="item_name" class="form-control" />
								<br>
								<label>Price</label>
								<input type="number" name="item_price" id="item_price" value="1000" step="500" class="form-control" />
								<br>
								<label>Category</label>
								<select name="item_cat" id="item_cat" class="form-control">
									<?php
									foreach( $rows as $row ) {
										echo "<option value='".$row['cat_id']."'>".$row['cat_name']."</option>";
									}
									?>
								</select>
								<br>
								<label>Stock</label>
								<input type="number" name="item_stock" id="item_stock" value="1" class="form-control" />
								<label>Description</label>
								<textarea name="item_desc" id="item_desc" placeholder="Describe your item here .." rows="4" cols="50" class="form-control" /></textarea>
							</div>
				      <div class="col-xs-6">
								<label>Image</label>
								<p><span id="item_uploaded_image"></span></p>
								<p><input type="file" name="item_image" id="item_image" /></p>
							</div>
				    </div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="method" id="method" value="Add"/>
						<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#update_button').prop('disabled', true);
	$('#delete_button').prop('disabled', true);
	// disable or enable buttons
	$('#item_data').on("click", 'tr', function(){
		var anyRowSelected = dataTable.rows( { selected: true } ).indexes().length === 0 ? false : true;	//	false - nothing selected. true - 1 or more are selected.
		if ( anyRowSelected ) {
			$('#update_button').prop('disabled', true);
			$('#delete_button').prop('disabled', true);
		} else {
			$('#update_button').prop('disabled', false);
			$('#delete_button').prop('disabled', false);
		}
	});
	// Activate an inline edit on click of a table cell
  $('#item_data').on( 'click', 'tbody td:not(:first-child)', function (e) {
  	editor.inline( this );
  } );
	// fetch data from MySQL
	var dataTable = $('#item_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				data: null,
        defaultContent: '',
        className: 'select-checkbox',
        orderable: false,
				targets: 0
			},
		],
	    select: {
	      style: 'os',
	      selector: 'td:first-child'
	    },
	    order: [[ 1, 'asc' ]],
	    dom: 'Blfrtip',
	    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	});

	$(document).on('click', '#add_button', function() {
		$('#item_form')[0].reset();
		$('.modal-title').text('Add Item');
		$('#method').val('Add');
		$('#action').val('Add');
		$('#item_uploaded_image').html('');
	});

	$(document).on('click', '#update_button', function() {
		var data = dataTable.rows( { selected: true } ).data();
		var item_id = data[0][1];
		// var user_id = $(this).attr("id");
		$('#method').val('Edit');
		$('#action').val('Edit');
		// fetch all data
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{item_id:item_id},
			dataType:"json",
			success:function( data ) {
				$('#itemModal').modal('show');
				$('.modal-title').text("Edit Item");
				// set user_id in the FormData for next action (update)
				$('#item_id').val(data.item_id);
				$('#item_name').val(data.item_name);
				$('#item_price').val(data.item_price);
				$("#item_cat option[value=" + data.cat_id + "]").prop("selected",true);
				$('#item_stock').val(data.item_stock);
				$('#item_uploaded_image').html(data.item_image);
				$('textarea#item_desc').text(data.item_desc);
			}
		});

	});

	$( document ).on( 'submit', '#item_form', function( event ) {
		event.preventDefault();
		// var user_id = $(this).attr("id");
		var item_name = $('#item_name').val();
		var extension = $('#item_image').val().split('.').pop().toLowerCase();

		if( extension != '' ) {
			if( jQuery.inArray( extension, ['gif','png','jpg','jpeg'] ) == -1 ) {
				alert( "Invalid Image File" );
				$('#item_image').val('');
				return false;
			}
		}

		if( item_name != '' ) {

			$.ajax({
				url:"actions.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function( response ) {
					alert( response );
					$('#itemModal').modal('hide');
					dataTable.ajax.reload();
				}
			});

		} else {
			alert("Item Field is Required");
		}

	});

	$(document).on('click', '#delete_button', function(){
		var data = dataTable.rows( { selected: true } ).data();
		var item_id = data[0][1];
		// set user_id in the FormData for next action (delete)
		$('#item_id').val(item_id);
		// var user_id = $(this).attr("id");
		if( confirm( "Are you sure you want to delete this?" ) ) {
			$.ajax({
				url:"actions.php",
				method:"POST",
				data:{method:'delete',item_id:item_id},
				success:function(data) {
					alert(data);
					dataTable.ajax.reload();
				}
			});
		} else {
			return false;
		}
	});

});
</script>
