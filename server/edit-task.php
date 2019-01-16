<?php

require 'helper.php';

if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['status']) ) {
	$id = htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
	$title = htmlspecialchars(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
	$status = htmlspecialchars(filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING));
	$query = "UPDATE tasks_list SET title = '$title',status = '$status' WHERE id = '$id'";

	$connection = connect();
	if (!$connection->error) {
		if ($success = mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo "Error occurred during editing task no. $id" . "<br>" . mysqli_error($connection);
		}
	}
}
