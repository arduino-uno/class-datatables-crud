<?php
class Class_DataTables_CRUD {

	public $conn = null;
	public $rows = array();

	public function getConnection() {

		try {

			if ( !defined( 'DB_HOST' ) || !defined( 'DB_USERNAME' ) || !defined( 'DB_PASSWORD' ) || !defined( 'DB_DATABASE_NAME' ) )  {
				throw new Exception( "\"db_config.php\" file is required." );
			} else {
				$this->conn = new mysqli( DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME );
				if ( mysqli_connect_errno() ) throw new Exception( mysqli_comysqli_connect_error() );
			}

		} catch ( Exception $exception ) {
			echo "Database could not be connected: " . $exception->getMessage() . "\r\n";
		}

		return false;

	}

	public function get_sql_exec( $query="select * from items" ) {

		try {

			$req = mysqli_query( $this->conn, $query );
			$this->rows = mysqli_fetch_all( $req, MYSQLI_ASSOC );
			if ( mysqli_num_rows( $req ) > 0 ) {
				return json_encode( $this->rows, JSON_PRETTY_PRINT );
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}
		} catch ( Exception $exception ) {
			return "Error description: " . $exception->getMessage();
		}

		mysqli_close( $this->conn );
		return false;

	}

	public function get_method( $table="items", $id_key="", $id_val="" ) {

		try {
			$query = "SELECT * FROM $table" . ( $id_key ? " WHERE $id_key='$id_val'" : "" );
			$req = mysqli_query( $this->conn, $query );
			$this->rows = mysqli_fetch_all( $req, MYSQLI_ASSOC );
			if ( mysqli_num_rows( $req ) > 0 ) {
				return json_encode( $this->rows, JSON_PRETTY_PRINT );
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}
		} catch ( Exception $exception ) {
			return "Error description: " . $exception->getMessage();
		}

		mysqli_close( $this->conn );
		return false;

	}

	public function post_method( $table="items", $sets=Array() ) {

		$arr_string = $this->arr2string( $sets );

		try {
			$sql = "INSERT INTO $table SET $arr_string";

			if ( mysqli_query( $this->conn, $sql ) ) {
				return "Data Inserted.";
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}

		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}

		return false;

	}

	public function put_method( $table="items", $sets=Array(), $id_key="", $id_val="" ) {

		$arr_string = $this->arr2string( $sets );

		try {
			$sql = "UPDATE $table SET $arr_string WHERE $id_key='$id_val'";

			if ( mysqli_query( $this->conn, $sql ) ) {
				return "Data Updated.";
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}

		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}

		return false;

	}

	public function delete_method( $table="items", $id_key="", $id_val="" ) {

		try {
			$sql = "DELETE FROM $table WHERE $id_key='$id_val'";

			if ( mysqli_query( $this->conn, $sql ) ) {
				return "Data Deleted.";
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}

		} catch ( Exception $exception ) {
			return $exception->getMessage();
		}

		return false;

	}

	public function get_total_all_records( $table="items" ) {

		try {
			$req = mysqli_query( $this->conn, "SELECT * FROM $table" );
			$this->rows = mysqli_fetch_all( $req, MYSQLI_ASSOC );
			if ( mysqli_num_rows( $req ) > 0 ) {
				return mysqli_num_rows( $req );
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}
		} catch ( Exception $exception ) {
			echo "Error description: " . $exception->getMessage();
		}

		mysqli_close( $this->conn );
		return false;
	}

	private function arr2string( $sets=Array() ) {

		array_walk( $sets,
			function (&$v, $k) {
				$v = $k.':'.'"'.$v.'"';
			}
		);

		$arr_string = str_replace( ':', '=', implode( ', ' , $sets ) );
		// $arr_string = str_replace( ':', '=', http_build_query( $sets, null, ',' ) );
		return $arr_string;

	}

	public function get_newid( $table="items", $id_key="", $prefix="DT" ) {

		try {

			$req = mysqli_query( $this->conn, "SELECT max( $id_key ) FROM $table" );
			$this->rows = mysqli_fetch_array( $req );
			if ( mysqli_num_rows( $req ) > 0 ) {
				$max_id = substr( $this->rows[0], 3, 3 );
				$inc_num = (int)$max_id + 1;
				$new_id = $prefix . "-00" . (string)$inc_num;
				return $new_id;
			} else {
				throw new Exception( mysqli_error( $this->conn ) );
			}

		} catch ( Exception $exception ) {
			echo "Error description: " . $exception->getMessage();
		}

		mysqli_close( $this->conn );
		return false;
	}

}
