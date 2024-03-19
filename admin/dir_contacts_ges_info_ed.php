<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
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
	
	/* format some vars */
	
	/* display results */
	
	echo '<h4 class="mb-4">Credenciales de Acceso</h5>';
	
	echo '<div class="card">';
		echo '<div class="card-header">Accesos<input type="button" name="edit1" id="edit1" value="Editar" class="btn btn-info btn-sm edit_data1 float-right"></div>';
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