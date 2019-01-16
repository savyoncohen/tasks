<?php
require 'helper.php';

// Edit an existing task
if(isset($_POST['myData'])){
	$data = json_decode($_POST['myData']);

	$connection = connect();
	if (!$connection->error) {
		$query = "UPDATE tasks_list SET title = '$data->title',status = '$data->status' WHERE id = '$data->id'";
		if ($success = mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo "Error occurred during editing task no. $data->id" . "<br>" . mysqli_error($connection);
		}
	}
}
