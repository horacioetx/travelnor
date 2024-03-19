<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	if(isset($_POST["contact_id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_contacts WHERE contact_id = :contact_id');
		$stmt->execute(array(':contact_id' => $_POST['contact_id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
?>