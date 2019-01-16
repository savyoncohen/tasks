<?php

require 'helper.php';

// Delete task from database
if(isset($_POST['myData'])){
	$data = json_decode($_POST['myData']);
	$query = "DELETE FROM tasks_list WHERE id = '$data->id'";

	$connection = connect();
	if (!$connection->error) {
		if ($success = mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}
	}
}
