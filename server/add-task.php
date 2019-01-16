<?php

require 'helper.php';

// Add new Task.
if(isset($_POST['myData'])){
	$data = json_decode($_POST['myData']);
	$date = date('Y-m-d H:i:s');

	$query = "INSERT INTO tasks_list (title,status, created) VALUES ('" . $data->title . "'," . "'$data->status'," . "'$date')";
	$connection = connect();
	if (!$connection->error) {
		if (mysqli_query($connection, $query)) {
			$last_id = mysqli_insert_id($connection);
			$success->id = $last_id;
			$success->date = $date;
			$success->status = $data->status;
			// Send the data back
			echo json_encode($success);
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}
	}
}



