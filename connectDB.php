<?php
	$obj = new connectDB();

	class connectDB {
		public $conn='';
		public $data=[];
		public function __construct() {

			$this->connectdatabase();
			if( isset( $_POST['action'] ) || isset( $_GET['action'] ) ) {
				
				if( isset( $_GET['action'] ) ) {

					$_POST['action'] = $_GET['action'];	
				
				} elseif( isset( $_POST['action'] ) ) {
				
					$_POST['action'] = $_POST['action'];
				
				} else {
				
					$_POST['action'] = '';
				
				}

				switch ( $_POST['action'] ) {
					case 'insert':
						return $this->insertEmployeeDetails();
					break;
					
					case 'update':
						return $this->updateEmployeeDetails();
					break;

					case 'delete':
						return $this->deleteEmployeeDetails();
					break;

					default:
						$this->fetchEmployeesDetails();
					break;
				}
			}
		}
		
		public function connectdatabase() {
			$this->conn = mysqli_connect("localhost","root","","employees");
			if(!$this->conn) {
				echo "connection failed" . mysqli_connect_error();
			}else{
				return true;
			}
		}

		public function insertEmployeeDetails() {

			$arrstrUpdatedData = $_POST;

			$sql = "INSERT INTO employees_details (
					employee_id, employee_name, date_of_birth, contact, designation, salary, email, address
				) VALUES 
				( 
					" . $arrstrUpdatedData['employee_id'] . ", 
					'" . $arrstrUpdatedData['employee_name'] . "',
					'" . $arrstrUpdatedData['date_of_birth'] . "', 
					'" . $arrstrUpdatedData['contact'] ."', 
					'" . $arrstrUpdatedData['designation'] . "', 
					'" . $arrstrUpdatedData['salary'] . "', 
					'" . $arrstrUpdatedData['email'] . "', 
					'" . $arrstrUpdatedData['address'] . "')";

				if( $this->conn->query( $sql ) == TRUE && 1 <= mysqli_affected_rows($this->conn) ) {
					$data['message'] = 'Data Updated SuccessFully';
					$data['success'] = true;
					$data['operation'] = 'update';
					echo json_encode($data);
				} else {
					$data['message'] = 'Failed to update Data';
					$data['success'] = false;
					$data['operation'] = 'update';
					echo json_encode($data);
				}
		}

		public function updateEmployeeDetails() {
			if( isset( $_GET['action'] ) ) {
				$_GET['action'] = '';
				session_start();
				$_SESSION['data'] = $this->fetchEmployeeDetails( $_GET['id'] );
				header( "Location: http://localhost/RPA/index.php" );
			} else {
				session_start();
				$arrstrUpdatedData = $_POST;
				$arrstrUpdatedData['id'] = $_SESSION['data']['id'];
				session_unset();
				session_destroy();

				$sql = "UPDATE employees_details SET
					id=" . (int) $arrstrUpdatedData['id'] . ",
					employee_id=" . $arrstrUpdatedData['employee_id'] . ",
					employee_name='" . $arrstrUpdatedData['employee_name'] . "',
					date_of_birth='" . $arrstrUpdatedData['date_of_birth'] . "',
					contact=" . $arrstrUpdatedData['contact'] . ",
					designation='" . $arrstrUpdatedData['designation'] . "',
					salary='" . $arrstrUpdatedData['salary'] . "',
					email='" . $arrstrUpdatedData['email'] . "',
					address='" . $arrstrUpdatedData['address'] . "' 
					WHERE id = " . $arrstrUpdatedData['id'];
				if( $this->conn->query( $sql ) == TRUE && 1 <= mysqli_affected_rows($this->conn) ) {
					$data['message'] = 'Data Updated SuccessFully';
					$data['success'] = true;
					$data['operation'] = 'update';
					echo json_encode($data);
				} else {
					$data['message'] = 'Failed to update Data';
					$data['success'] = false;
					$data['operation'] = 'update';
					echo json_encode($data);
				}
			}
		}

		public function deleteEmployeeDetails() {
			$sql = "DELETE FROM employees_details WHERE id = " . $_GET['id'] ;

			if( $this->conn->query( $sql ) == TRUE ) {
				header( "Location: http://localhost/RPA/employee_details.php" );
			} else {
				echo 'Employee not deleted';
				header( "Location: http://localhost/RPA/employee_details.php" );
			}
		}

		public function fetchEmployeesDetails() {
			$sql = "SELECT * FROM employees_details";

			if( $this->conn->query( $sql ) == TRUE ) {
				$result = $this->conn->query( $sql );
				while( $row = $result->fetch_assoc() ) {
				    $arrstrResults[] = $row;
				}
			} else {
				$arrstrResults = null;
			}
			return $arrstrResults;
		}

		public function fetchEmployeeDetails( $intId ) {
			$sql = "SELECT * FROM employees_details WHERE id = " . (int) $intId;

			if( $this->conn->query( $sql ) == TRUE ) {
				$result = $this->conn->query( $sql );
				$arrstrResult = $result->fetch_assoc();
			} else {
				$arrstrResult = null;
			}
			return $arrstrResult;
		}

		public function fetchCountOfRecords() {
			$sql = "SELECT count(*) FROM employees_details";

			if( $this->conn->query( $sql ) == TRUE ) {
				$result = $this->conn->query( $sql );
				$intResult = $result->fetch_assoc();
			} else {
				$intResult = null;
			}
			return (int)$intResult['count(*)'];
		}
	}
?>