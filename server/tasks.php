<?php

// Set connection to the database.
function connect() {
	$conn = mysqli_connect('localhost', 'root', 'root', 'tasks') or die("Error connecting to the database");
	return $conn;
}

function CloseCon($conn) {
	$conn->close();
}
// connect to database once
$connection = connect();

// Fetch tasks from database if there is a connection
if(!empty($_GET['data'])) {
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
}

// Add new Task.
if(isset($_POST['addData'])){
	$data = json_decode($_POST['addData']);
	$date = date('Y-m-d H:i:s');
	$query = "INSERT INTO tasks_list (title,status, created) VALUES ('" . $data->title . "'," . "'$data->status'," . "'$date')";
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

// Delete task from database
if(isset($_POST['deleteData'])){
	$data = json_decode($_POST['deleteData']);
	$query = "DELETE FROM tasks_list WHERE id = '$data->id'";
	if (!$connection->error) {
		if ($success = mysqli_query($connection, $query)) {
			echo 'success';
		}
		else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}
	}
}

// Edit an existing task
if(isset($_POST['editData'])){
	$data = json_decode($_POST['editData']);
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

