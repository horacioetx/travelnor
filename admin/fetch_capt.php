<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* fetch data */
		
	if ($_POST['capid'] == 1) {	
		$stmt = $db->prepare('SELECT program_banner_cap1 FROM dir_programs WHERE program_id = :program_id');
	} elseif ($_POST['capid'] == 2) {
		$stmt = $db->prepare('SELECT program_banner_cap2 FROM dir_programs WHERE program_id = :program_id');
	} elseif ($_POST['capid'] == 3) {
		$stmt = $db->prepare('SELECT program_banner_cap3 FROM dir_programs WHERE program_id = :program_id');
	} elseif ($_POST['capid'] == 4) {
		$stmt = $db->prepare('SELECT program_banner_cap4 FROM dir_programs WHERE program_id = :program_id');
	}		
	
	$stmt->execute(array(':program_id' => $_POST['prog_id']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if ($_POST['capid'] == 1) {	
		echo $row['program_banner_cap1'];
	} elseif ($_POST['capid'] == 2) {
		echo $row['program_banner_cap2'];			
	} elseif ($_POST['capid'] == 3) {
		echo $row['program_banner_cap3'];			
	} elseif ($_POST['capid'] == 4) {
		echo $row['program_banner_cap4']; 
	}	 
	 
?>