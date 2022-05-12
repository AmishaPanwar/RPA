<!DOCTYPE html>
<html>
	<head>
		<title>Add Employee</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  </head>
  <?php
  	session_start();
  	if( isset( $_SESSION['data'] ) ) {
  		$arrstrData = $_SESSION['data'];
  	}
  ?>
    <body>
    	<div class="container container-fluid">
    		<form class="mt-5" method="POST" action="" id="form">
    			<h2 class="text-center mt-5 text-primary">Employee Detail Form</h2>
					<div class="row mt-5">
	    			<div class="col-lg-6">
	             		<h5>Employee ID :<input type="number" class="form-control input-sm mt-1 p-2" Name="employee_id" id="employee_id" value="<?=isset( $arrstrData['employee_id'] ) ? $arrstrData['employee_id'] : '' ;?>"/></h5>
	    			</div>
	    			<div class="col-lg-6">
	    				<h5>Employee Name :<input type="text" class="form-control input-sm mt-1 p-2" Name="employee_name" id="employee_name" value="<?=isset( $arrstrData['employee_name'] ) ? $arrstrData['employee_name'] : '';?>"/></h5>
	    			</div>
   				</div>
   			    <div class="row mt-3">
		    			<div class="col-lg-6">
		             		<h5>Date Of Birth :<input type="date" class="form-control input-sm mt-1 p-2" Name="date_of_birth" id="date_of_birth" value="<?=isset( $arrstrData['date_of_birth'] ) ? $arrstrData['date_of_birth'] : '';?>"/></h5>
		    			</div>

		    			<div class="col-lg-6">
		    				<h5>Contact No :<input type="number" class="form-control input-sm mt-1 p-2" Name="contact" id="contact" value="<?=isset( $arrstrData['contact'] ) ? $arrstrData['contact'] : '';?>"/></h5>
		    			</div>
   					</div>
   				<div class="row mt-3">
	    			<div class="col-lg-6">
	             		<h5>Designation :<input type="text" class="form-control input-sm mt-1 p-2" Name="designation" id="designation" value="<?=isset( $arrstrData['designation'] ) ? $arrstrData['designation'] : '';?>"/></h5>
	    			</div>

	    			<div class="col-lg-6">
	    				<h5>Salary :<input type="text" class="form-control input-sm mt-1 p-2" Name="salary" id="salary" value="<?= isset( $arrstrData['salary'] ) ? $arrstrData['salary'] : '';?>"/></h5>
	    			</div>
   				</div>
   				<div class="row mt-3">
	    			<div class="col-lg-6">
	             		<h5>Email :<input type="email" class="form-control input-sm mt-1 p-2" Name="email" id="email"
	             			value="<?= isset( $arrstrData['email'] ) ? $arrstrData['email'] : '';?>"/></h5>
	    			</div>

	    			<div class="col-lg-6">
	    				<h5>Address :<input type="text" class="form-control input-sm mt-1 p-2" Name="address" id="address"
	    					value="<?=isset( $arrstrData['address'] ) ? $arrstrData['address'] : '' ;?>"/></h5>
	    			</div>
   				</div>
   				<div class="col-lg-12 d-flex flex-row-reverse mb-3 mt-4">
    				<button type="submit" class="btn btn-success btn-lg" id="submit" name="submit" value="<?=isset( $arrstrData['employee_id'] ) ? 'update':'insert'?>"><?=isset( $arrstrData['employee_id'] ) ? 'Update':'Submit'?></button>
    			</div>
   		</form>
   	</div>
	</body>
	<script>
    $(document).ready(function () {
	  	$("#form").submit(function (event) {
	    	var formData = {
		      employee_id: $("#employee_id").val(),
		      employee_name: $("#employee_name").val(),
		      date_of_birth: $("#date_of_birth").val(),
		      contact: $("#contact").val(),
		      salary: $("#salary").val(),
		      designation: $("#designation").val(),
		      email: $("#email").val(),
		      address: $("#address").val(),
		      action: $("#submit").val()
		    };

		    $.ajax({
		      type: "POST",
		      url: "connectDB.php",
		      data: formData,
		      dataType: "json",
		      encode: true,
		    }).done(function (data) {
		    	if( data.operation == 'update' ) {
			      if(data.success){
			        $("#form").html(
			          '<div class="alert alert-success">' + data.message + "</div>"
			        );
			        window.location = "http://localhost/RPA/employee_details.php?success=true&operation=update";
			      } else {
			      	$("#form").html(
			          '<div class="alert alert-danger">' + data.message + "</div>"
			        );
			        window.location = "http://localhost/RPA/employee_details.php?success=false&operation=update";
			      }
			    } else {
			    	if(data.success){
			        $("#form").html(
			          '<div class="alert alert-success">' + data.message + "</div>"
			        );
			        window.location = "http://localhost/RPA/employee_details.php?success=true&operation=insert";
			      } else {
			      	$("#form").html(
			          '<div class="alert alert-danger">' + data.message + "</div>"
			        );
			        window.location = "http://localhost/RPA/employee_details.php?success=false&operation=insert";
			      }
			    }
				});
		    event.preventDefault();
		  });
		});
	</script>
</html>
<?php 
	//require_once( 'connectDB.php' );
?>