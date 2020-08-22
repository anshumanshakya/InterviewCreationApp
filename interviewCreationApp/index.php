<?php

	include('connect.php');
	 if(isset($_POST['create'])){
	 	try{
	 	if(sizeof($_POST['check_list']) > 1){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $i => $selected){
			 $date = $_POST['date'];
			 $startTime = $_POST['startTime'];
			 $endTime = $_POST['endTime'];
		 
		 	$available = mysqli_query($con, "select * from interviewlist where interviewlist.Name = '$selected' AND interviewlist.Date = '$date'");
	 		if (!$available) {
				die('Invalid query: ' . mysqli_error($con));
			}
	 		while($data = mysqli_fetch_array($available)){
	 			//echo $data['StartTime'];
	 			if($startTime >= $data['StartTime'] && $startTime <= $data['EndTime']){
	 				throw new Exception("One or more participants is not available");
	 			}
	 		}
		 	$stat = mysqli_query($con, "insert into interviewlist(Name, Date, StartTime, EndTime) values('$selected','$date','$startTime','$endTime')");
			 }
		}
		else throw new Exception("Select at least 2 participants");
		}
		catch(Exception $e){
			$error_msg=$e->getMessage();
		}

	 }

?>

<!DOCTYPE html>
<html>
<head>

	<title>Interview Creation</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
	 
	<link rel="stylesheet" href="styles.css" >
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<center>

<header>

  <h1>Interview Creation App</h1>
  	<div class="navbar">
	  <a href="index.php">Create Interview</a>
	  <a href="list.php">View</a>
	  <a href="edit.php">Edit</a>
	</div>


</header>

<?php
//printing error message
if(isset($error_msg))
{
	echo $error_msg;
}
?>

<div class="content">
	<div class="row">

		<form action="" method="post" class="form-horizontal col-md-6 col-md-offset-3">
			<center>

				<h3>Select Participants for Interview</h3>
				    
				    <br>
				    <table class="table table-stripped">
				      <thead>
				        <tr>
				          <th scope="col">Participant id</th>
				          <th scope="col">Name</th>
				          <th scope="col">Select</th>
				        </tr>
				      </thead>

				   <?php
				     
				     $i=0;
				     
				     $all_query = mysqli_query($con, "select * from participants order by id asc ");
				     if (!$all_query) {
						die('Invalid query: ' . mysqli_error($con));
					}
				     while ($data = mysqli_fetch_array($all_query)) {
				       $i++;
				     
				     ?>
				  <tbody>
				     <tr>
				       <td><?php echo $data['id']; ?></td>
				       <td><?php echo $data['participants']; ?></td>
				       <td>
				         <input type="checkbox" name="check_list[]" value="<?php echo $data['participants']; ?>">
				       </td>
				     </tr>
				  </tbody>

				     <?php 
				          } 
				      ?>
				      
				    </table>
				 <label>Date</label>
				 <input type="date" name="date">
				 <label>Start Time</label>
				 <input type="time" name="startTime">
				 <label>End Time</label>
				 <input type="time" name="endTime">
				<input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Create" name="create" />
				</center>
		</form>
	</div>
</div>


</center>
</body>
</html>