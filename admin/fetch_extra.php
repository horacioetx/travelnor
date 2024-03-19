<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* fetch data */
	
	if(isset($_POST["id"])) {
	
		$stmt = $db->prepare('SELECT * FROM dir_programs_extrainfo WHERE prog_ext_id = :prog_ext_id');
		$stmt->execute(array(':prog_ext_id' => $_POST['id']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		echo json_encode($row);  
		
	}  
 
 ?>