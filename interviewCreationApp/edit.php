<?php

	include('connect.php');
	if(isset($_POST['save'])){
	 	try{
	 	// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $i => $selected){
			 $date = $_POST['newdate'];
			 $startTime = $_POST['newstartTime'];
			 $endTime = $_POST['newendTime'];
			 $sql = mysqli_query($con, "UPDATE interviewlist SET Date='$date', StartTime = '$startTime', EndTime = '$endTime' WHERE Name='$selected'");
		 
		}
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

<center>
<div class="row">

  <div class="content">
    <h3>Interview List</h3>
    <br>
    <form action="" method="post">
    <table class="table table-stripped">
				      <thead>
				        <tr>
				          <th scope="col">Name</th>
				          <th scope="col">Date</th>
				          <th scope="col">Start Time</th>
				          <th scope="col">End Time</th>
				          <th scope="col">Edit</th>
				        </tr>
				      </thead>

				   <?php
				     
				     $i=0;
				     
				     $all_query = mysqli_query($con, "select * from interviewlist order by StartTime asc");
				     if (!$all_query) {
						die('Invalid query: ' . mysqli_error($con));
					}
				     while ($data = mysqli_fetch_array($all_query)) {
				       $i++;
				     
				     ?>
				  <tbody>
				     <tr>
				       <td><?php echo $data['Name']; ?></td>
				       <td><?php echo $data['Date']; ?></td>
				       <td><?php echo $data['StartTime']; ?></td>
				       <td><?php echo $data['EndTime']; ?></td>
				       <td>
				         <input type="checkbox" name="check_list[]" value="<?php echo $data['Name']; ?>">
				       </td>
				     </tr>
				  </tbody>

				     <?php 
				          } 
				      ?>
				      
				    </table>
					<label>New Date</label>
					<input type="date" name="newdate">
					<label>New Start Time</label>
					<input type="time" name="newstartTime">
					<label>New End Time</label>
					<input type="time" name="newendTime">
				    <input type="submit" class="btn btn-primary" value="Save" name="save" style="width:100px;" />
				    </form>
</div>
</div>
</center>
</body>
</html>