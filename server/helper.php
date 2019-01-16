<?php

function connect() {

	$conn = mysqli_connect('localhost','root','root','tasks') or die("Error connecting to the database");
	return $conn;
}

function CloseCon($conn) {
	$conn->close();
}
