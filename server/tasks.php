<?php

require 'helper.php';
global $connection;

// Fetch tasks from database if there is a connection
$connection = connect();

if (!$connection->error) {
	$result = mysqli_query($connection, 'SELECT * FROM tasks_list');
	if (mysqli_num_rows($result) > 0) {
		$tasks = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$tasks[] = $row;
		}
		echo json_encode($tasks);
	}
}
else {
	echo json_encode('fail');
}


