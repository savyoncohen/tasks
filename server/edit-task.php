<?php
require 'helper.php';

// Edit an existing task
if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['status'])) {
	$id = htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
	$title = htmlspecialchars(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
	$status = htmlspecialchars(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING));

	$connection = connect();
	if (!$connection->error) {
		$query = "UPDATE tasks_list SET title = '$title',status = '$status' WHERE id = '$id'";
		if ($success = mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo "Error occurred during editing task no. $id" . "<br>" . mysqli_error($connection);
		}
	}
}
