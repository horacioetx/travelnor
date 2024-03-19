<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* fetch data */	
	
    $stmt = $db->prepare('SELECT * FROM config LIMIT 1');
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($row);   
 
 ?>