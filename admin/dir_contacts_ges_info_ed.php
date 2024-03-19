<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* receive vars */	
	
	$stmt = $db->prepare("UPDATE dir_contacts SET 
							contact_ges_website = :contact_ges_website,
							contact_ges_user = :contact_ges_user,
							contact_ges_code = :contact_ges_code						
							WHERE contact_id = :contact_id");
							
	$stmt->execute(array(':contact_ges_website' => $_POST['contact_ges_website'],
						 ':contact_ges_user' => $_POST['contact_ges_user'],
						 ':contact_ges_code' => $_POST['contact_ges_code'],
						 ':contact_id' => $_POST['contact_id2']));
	
	/* proceed to buld display */
	
	$contact_id = $_POST['contact_id2'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT contact_ges_website, contact_ges_user, contact_ges_code FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $contact_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* display results */

	echo '<h5 class mb-3><strong>Credenciales de Acceso</strong></h5>';

	echo '<div class="card easion-card h-100">';

		echo '<div class="card-header d-flex justify-content-between align-items-center">Accesos<button type="button" name="edit1" id="edit1" value="Editar" class="btn btn-info btn-sm edit_data1 float-right"><i class="fas fa-pencil-alt"></i></button></div>';
		
		echo '<div class="card-body">';
			echo '<div class="row">';
				echo '<div class="col">';
					echo '<p class="card-text"><strong>Website : </strong><a href="http://' . $rrows['contact_ges_website'] . '" style="color:#0056b3;" target="_blank">' . $rrows['contact_ges_website']  . '</a></p>';
					echo '<p class="card-text"><strong>Usuario : </strong>' . $rrows['contact_ges_user']  . '</p>';	
					echo '<p class="card-text"><strong>Código de Acceso : </strong>' . $rrows['contact_ges_code']  . '</p>';							
				echo '</div>';
			echo '</div>';
		echo '</div>';

	echo '</div>';
	
?>