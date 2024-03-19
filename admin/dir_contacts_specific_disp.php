<?php

	/* Type of contact = CLI*/

	if ($ctc_type == "CLI") {
		
		echo '<h4 class="mb-4">Subcontactos<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#newsubcontact">Agregar Subcontacto</button></h4>';
		
		$stmt_x = $db->prepare('SELECT * FROM dir_subcontacts WHERE subcontact_contact = :subcontact_contact ORDER BY subcontact_name');
		$stmt_x->bindParam(':subcontact_contact', $_REQUEST['contact_id']);			
		$stmt_x->execute();	
		
		$numitems = $stmt_x->rowCount();
		
		if ($numitems == 0) {
		
			echo '<div class="alert alert-danger mt-2" role="alert">';
				echo 'No hay subcontactos!';
			echo '</div>';		
		
		} else {
			
			$output = "";
			$cont1 = 0;
			
			while ($rrows_x = $stmt_x->fetch(PDO::FETCH_ASSOC)) {
				
				echo '<div id="' . $rrows_x['subcontact_id']. '">';
				
					$del = '<a data-org="subcontact" data-row-id="' . $rrows_x['subcontact_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_subcontact float-right ml-3">Eliminar</a>';
					$edit = '<input type="button" name="edit" value="Editar" subid="' . $rrows_x['subcontact_id'] . '" class="btn btn-info btn-sm edit_data_sub float-right">';
					
					echo '<div class="card mt-3">';
						echo '<h5 class="card-header"><span><strong>' . $rrows_x['subcontact_name'] . " " . $rrows_x['subcontact_lastname'] . '</strong></span><span>' . $del . '</span><span>' . $edit . '</span></h5>';
						echo '<div class="card-body">';
							echo '<div class="row">';
								echo '<div class="col">';
								
									echo '<p class="card-text"><strong>Alias : </strong>' . $rrows_x['subcontact_alias'] . '</p>';									
									echo '<p class="card-text"><strong>Teléfono : </strong><a href="tel:' . $rrows_x['subcontact_phone'] . '" style="color:#0056b3;">' . $rrows_x['subcontact_phone'] . '</a></p>';
									echo '<p class="card-text"><strong>Email : </strong><a href="mailto:' . $rrows_x['subcontact_email'] . '" style="color:#0056b3;">' . $rrows_x['subcontact_email']. '</a></p>';	
									
									if ($_SESSION['level'] > 1) {
									
										echo '<hr>';
										
										echo '<p class="card-text"><strong>Fecha Nacimiento : </strong>' . $rrows_x['subcontact_dob']. '</p>';
										echo '<p class="card-text"><strong>Nacionalidad : </strong>' . $rrows_x['subcontact_nationality']. '</p>';
										echo '<p class="card-text"><strong>Pasaporte No. : </strong>' . $rrows_x['subcontact_pass_num']. '</p>';	
										echo '<p class="card-text"><strong>Pasaporte Expira : </strong>' . $rrows_x['subcontact_pass_exp']. '</p>';
										echo '<p class="card-text"><strong>DNI : </strong>' . $rrows_x['subcontact_dni']. '</p>';
										echo '<p class="card-text"><strong>DNI Expira : </strong>' . $rrows_x['subcontact_dni_exp']. '</p>';

									}

									echo '<hr>';
				
									if ($rrows_x['subcontact_newsletter1'] == 1)
										echo '<p class="card-text"><strong>Newsletter TRA : </strong>SI</p>';
									else
										echo '<p class="card-text"><strong>Newsletter TRA : </strong>NO</p>';
									
									if ($rrows_x['subcontact_newsletter2'] == 1)
										echo '<p class="card-text"><strong>Newsletter CUC : </strong>SI</p>';
									else
										echo '<p class="card-text"><strong>Newsletter CUC : </strong>NO</p>';
									
									echo '<hr>';
									
									echo '<p class="card-text"><strong>Notas : </strong>' . nl2br($rrows_x['subcontact_notes']) . '</p>';
									
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				echo '</div>';
				
			}
			
		}
		
	}
	
	/* Type of contact = PRO*/

	if ($ctc_type == "PRO") {
		
		echo '<h4 class="mb-4">Subcontactos<button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#newsubcontact">Agregar Subcontacto</button></h5>';
		
		$stmt_x = $db->prepare('SELECT * FROM dir_subcontacts WHERE subcontact_contact = :subcontact_contact ORDER BY subcontact_name');
		$stmt_x->bindParam(':subcontact_contact', $_REQUEST['contact_id']);			
		$stmt_x->execute();	
		
		$numitems = $stmt_x->rowCount();
		
		if ($numitems == 0) {
		
			echo '<div class="alert alert-danger mt-2" role="alert">';
				echo 'No hay subcontactos!';
			echo '</div>';		
		
		} else {
			
			$output = "";
			$cont1 = 0;
			
			while ($rrows_x = $stmt_x->fetch(PDO::FETCH_ASSOC)) {
				
				echo '<div id="' . $rrows_x['subcontact_id']. '">';
				
					$del = '<a data-org="subcontact" data-row-id="' . $rrows_x['subcontact_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_subcontact float-right ml-3">Eliminar</a>';
					$edit = '<input type="button" name="edit" value="Editar" subid="' . $rrows_x['subcontact_id'] . '" class="btn btn-info btn-sm edit_data_sub float-right" disabled>';

					echo '<div class="card mt-3">';
						echo '<h5 class="card-header"><span><strong>' . $rrows_x['subcontact_name'] . " " . $rrows_x['subcontact_lastname'] . '</strong></span><span>' . $del . '</span><span>' . $edit . '</span></h5>';
						echo '<div class="card-body">';
							echo '<div class="row">';
								echo '<div class="col">';
									echo '<p class="card-text"><strong>Alias : </strong>' . $rrows_x['subcontact_alias'] . '</p>';									
									echo '<p class="card-text"><strong>Teléfono : </strong><a href="tel:' . $rrows_x['subcontact_phone'] . '" style="color:#0056b3;">' . $rrows_x['subcontact_phone'] . '</a></p>';
									echo '<p class="card-text"><strong>Email : </strong><a href="mailto:' . $rrows_x['subcontact_email'] . '" style="color:#0056b3;">' . $rrows_x['subcontact_email']. '</a></p>';	
									
									echo '<hr>';
				
									if ($rrows_x['subcontact_newsletter1'] == 1)
										echo '<p class="card-text"><strong>Newsletter TRA : </strong>SI</p>';
									else
										echo '<p class="card-text"><strong>Newsletter TRA : </strong>NO</p>';
									
									if ($rrows_x['subcontact_newsletter2'] == 1)
										echo '<p class="card-text"><strong>Newsletter CUC : </strong>SI</p>';
									else
										echo '<p class="card-text"><strong>Newsletter CUC : </strong>NO</p>';
									
									echo '<hr>';
									
									echo '<p class="card-text"><strong>Notas : </strong>' . nl2br($rrows_x['subcontact_notes']) . '</p>';									
									
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					
				echo '</div>';
				
			}
			
		}
		
	}

	/* Type of contact = GES*/
	
	if ($ctc_type == "GES") {
		
		if ($_SESSION['level'] > 1) {
		
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
			
		}
		
	}

?>

<!-- delete subcontact function -->

<script>
	$(document).ready(function(){
		$('.delete_subcontact').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			var parent = $("#"+rowid);					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar este subcontacto?</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Subcontacto!",
				buttons: {
					success: {
						label: "No",
						className: "btn-success",
						callback: function() {
							$('.bootbox').modal('hide');
						}
					},
					danger: {
						label: "Eliminar",
						className: "btn-danger",
						callback: function() {
							$.ajax({
								type: 'POST',
								url: 'delete_records.php',
								data: dataString,
							})
							.done(function(response){
								bootbox.alert(response);
								parent.fadeOut('slow');
							})
							.fail(function(){
								bootbox.alert('Error. No se pudo eliminar subcontacto');
							})
						}
					}
				}
			});
		});
	});
</script>