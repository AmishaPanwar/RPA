<!DOCTYPE html>
<html>
<head>
	<title>List Of Employees</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<?php 
		require_once( 'connectDB.php' ); 

	  	$obj = new connectDB();
  		$intCountOfEmployees = $obj->fetchCountOfRecords();

		if( true == isset( $_GET['success'] ) ) {
			$strClass = 'alert alert-success text-success fs-4';
		} elseif( false == isset( $_GET['success'] ) ) {
			$strClass = 'alert alert-danger text-danger fs-4';
		} else {
			$strClass = 'd-none';
		}
	?>
	<form>
		<div class="text-center fs-2 text-primary mt-5">Employee Details</div>
		<div class="<?php $strClass ?>" id="result"> <?php 
			if( isset( $_GET['operation'] ) && 'update' == $_GET['operation'] ) {
				isset( $_GET['success'] ) ? 'Record Updated SuccessFully' : 'Record Updation Failed';
			} else {
				isset( $_GET['success'] ) ? 'Record Inserted SuccessFully' : 'Record Insertion Failed';
			}
		?>
		</div>
		<div class="mt-3">
			<div class="fw-bold fs-3 text-secondary container-fluid">
				Employees( <?= $intCountOfEmployees ?> )
			</div>
			<div class="container-fluid mt-2">
				<div class="btn btn-primary px-3 py-2" id="addEmployee"><a href="index.php" class="text-white text-decoration-none">Add Employee</a></div>
			</div>
		</div>	
		<div class="container-fluid">
			<table class="table table-bordered table-striped table-hover mt-2">
				<thead class="bg-blue-active">
					<tr>
						<th>S No.</th>
						<th>Employee ID</th>
						<th>Employee Name</th>
						<th>Date Of Birth</th>
						<th>Contact No</th>
						<th>Designation</th>
						<th>Salary</th>
						<th>Email</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$obj = new connectDB();
						$arrstrResults = $obj->fetchEmployeesDetails();
						$count=1;
						if( is_array( $arrstrResults ) ) {
							foreach( $arrstrResults as $arrstrResult ) {
					?>
								<tr>
									<td><?= $count; ?></td>
									<td><?= $arrstrResult['employee_id']; ?></td>
									<td><?= $arrstrResult['employee_name']; ?></td>
									<td><?= $arrstrResult['date_of_birth']; ?></td>
									<td><?= $arrstrResult['contact']; ?></td>
									<td><?= $arrstrResult['designation']; ?></td>
									<td><?= $arrstrResult['salary']; ?></td>
									<td><?= $arrstrResult['email']; ?></td>
									<td><?= $arrstrResult['address']; ?></td>
									<td>
										<a href="connectDB.php?action=update&id=<?= $arrstrResult['id'];?>" class="text-decoration-none">Edit</a>
										<text class="text-primary">/</text>
										<a href="connectDB.php?action=delete&id=<?= $arrstrResult['id'];?>" class="text-decoration-none" onclick="return confirm('Are you sure, you want to delete it?')">Delete</a>
									</td>
								</tr>
					<?php
								$count++;
							}
						} else {
					?><div class="alert alert-success text-center text-success fw-bold">No Record Found </div>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</form>
	</body>
</html>