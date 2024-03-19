<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	

    $rowid = $_POST['rowid'];
    $status = 1;

    /* retrieve current status to switch */

    $stmt = $db->prepare('SELECT task_status FROM todo WHERE task_id = :task_id');
    $stmt->bindParam(':task_id', $rowid);
    $stmt->execute();
    $rowsta = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($rowsta['task_status'] == 1)
        $status = 0;
    else
        $status = 1;

    /* update status */
	
	$stmt = $db->prepare("UPDATE todo SET 
							task_status = :task_status
							WHERE task_id = :task_id");
							
	$stmt->execute(array(':task_status' => $status,
						 ':task_id' => $rowid));
	
	/* display results */
	
	include 'todolist.php';
	
?>