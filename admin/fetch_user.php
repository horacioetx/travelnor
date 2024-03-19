<?php  

	/* fetch_user.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* fecth info */
	
	if(isset($_POST["id"])) {
	
		$stmt = $db->prepare('SELECT * FROM utenti WHERE id = :id');
		$stmt->execute(array(':id' => $_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>