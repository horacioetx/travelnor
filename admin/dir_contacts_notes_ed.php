<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_contacts SET 
							contact_notes = :contact_notes						
							WHERE contact_id = :contact_id");
							
	$stmt->execute(array(':contact_notes' => $_POST['contact_notes'],
						 ':contact_id' => $_POST['contact_id3']));
	
	/* proceed to buld display */
	
	$contact_id = $_POST['contact_id3'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT contact_notes FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $contact_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* format some vars */
	
	/* display results */
	
	echo '<div class="card easion-card h-100">';
		echo '<div class="card-header d-flex justify-content-between align-items-center"><strong>Notas</strong><button type="button" name="edit_nt" id="edit_nt" value="Editar" class="btn btn-info btn-sm edit_notes float-right"><i class="fas fa-pencil-alt"></i></button></div>';
		echo '<div class="card-body">';	
			echo '<div class="row">';
				echo '<div class="col">';
					echo '<p class="card-text">' . nl2br($rrows['contact_notes']) . '</p>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	
?>



