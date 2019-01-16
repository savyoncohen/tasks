<?php

require 'helper.php';
if(!empty($_POST['id'])) {
	$id = htmlspecialchars(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
	$query = "DELETE FROM tasks_list WHERE id = '$id'";

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
