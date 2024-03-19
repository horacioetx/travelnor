<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	

    $today = date("Y-m-d H:i:s");
	
	$stmt = $db->prepare('INSERT todo (task, priority, user_id, date_create) VALUES (:task, :priority, :user_id, :date_create)');
							
	$stmt->execute(array(':task' => $_POST['task'],
						 ':priority' => $_POST['priority'],
						 ':user_id' => $_SESSION['user'],
						 ':date_create' => $today));
	
	/* display results */	

	include 'todolist.php';

?>