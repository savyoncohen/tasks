<?php
require 'helper.php';


if(isset($_POST['title']) && isset($_POST['status'])) {
	$title = htmlspecialchars(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
	$status = htmlspecialchars(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING));
	$date = date('Y-m-d H:i:s');

	$query = "INSERT INTO tasks_list (title,status, created) VALUES ('" . $title . "',". "'$status'," . "'$date')";
	$connection = connect();
	if(!$connection->error) {
		if (mysqli_query($connection, $query)) {
			$last_id = mysqli_insert_id($connection);
			$success->id = $last_id;
			$success->create = $date;
			$success->status = $status;
			echo json_encode($success);
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}
	}
}



