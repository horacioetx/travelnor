<?php

	/* Display Contact General Info */
	
	$del = '<a data-org="contact" data-row-id="' . $rrows['contact_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_contact float-right ml-3">Eliminar</a>';

?>

<h4 class="mb-4">Contacto Principal</h4>

<div class="card">
	<h5 class="card-header"><strong><?php echo $rrows['contact_name'] . " "  . $rrows['contact_lastname']; ?></strong><?php echo $del; ?><input type="button" name="edit0" id="edit0" value="Editar" class="btn btn-info btn-sm edit_data0 float-right"></h5>
	<div class="card-body">	
		<div class="row">
			<div class="col">
			
				<?php 
				
					if ($ctc_type == "CLI") {
					
						echo '<p class="card-text"><strong>Alias : </strong>' . $rrows['contact_alias'] . '</p>';
						
					} elseif ($ctc_type == "PRO") {
						
						echo '<p class="card-text"><strong>Nombre Comercial : </strong>' . $rrows['contact_alias'] . '</p>';
						
					} elseif ($ctc_type == "GES") {
						
						echo '<p class="card-text"><strong>Nombre Comercial : </strong>' . $rrows['contact_alias'] . '</p>';
						
					}						
						
				?>
				
				<hr>
				
				<p class="card-text"><strong>Clasificación 1A / 1B : </strong><?php echo $rrows['contact_classif0'] . " / " . $rrows['contact_classif1']; ?></p>
				<p class="card-text"><strong>Clasificación 2 : </strong><?php echo $rrows['contact_classif2']; ?></p>
				
				<hr>
				
				<p class="card-text"><strong>Dirección : </strong><?php echo $rrows['contact_address1'] . ", " . $rrows['contact_address2']; ?></p>
				<p class="card-text"><strong>Ciudad : </strong><?php echo $rrows['contact_city']; ?></p>
				<p class="card-text"><strong>Código Postal : </strong><?php echo $rrows['contact_pc']; ?></p>
				<p class="card-text"><strong>País : </strong><?php echo $rrows['contact_country']; ?></p>				
				<p class="card-text"><strong>Teléfono 1 : </strong><a href="tel:<?php echo $rrows['contact_phone']; ?>" style="color:#0056b3;"><?php echo $rrows['contact_phone']; ?></a></p>
				<p class="card-text"><strong>Teléfono 2 : </strong><?php echo $rrows['contact_fax']; ?></p>
				<p class="card-text"><strong>Email : </strong><a href="mailto:<?php echo $rrows['contact_email']; ?>" style="color:#0056b3;"><?php echo $rrows['contact_email']; ?></a></p>
				
				<?php
				
					if ($ctc_type == "CLI") {
						
						if ($_SESSION['level'] > 1) {
				
							echo '<hr>';
						
							echo '<p class="card-text"><strong>Fecha Nacimiento : </strong>' . $rrows['contact_dob'] . '</p>';
							echo '<p class="card-text"><strong>Nacionalidad : </strong>' . $rrows['contact_nationality'] . '</p>';
							echo '<p class="card-text"><strong>Pasaporte No. : </strong>' . $rrows['contact_pass_num'] . '</p>';
							echo '<p class="card-text"><strong>Pasaporte Expira : </strong>' . $rrows['contact_pass_exp'] . '</p>';
							echo '<p class="card-text"><strong>DNI : </strong>' . $rrows['contact_dni'] . '</p>';
							echo '<p class="card-text"><strong>DNI Expira : </strong>' . $rrows['contact_dni_exp'] . '</p>';
							
						}
				
						echo '<hr>';
				
						if ($rrows['contact_newsletter1'] == 1)
							echo '<p class="card-text"><strong>Newsletter TRA : </strong>SI</p>';
						else
							echo '<p class="card-text"><strong>Newsletter TRA : </strong>NO</p>';
						
						if ($rrows['contact_newsletter2'] == 1)
							echo '<p class="card-text"><strong>Newsletter CUC : </strong>SI</p>';
						else
							echo '<p class="card-text"><strong>Newsletter CUC : </strong>NO</p>';

					} elseif ($ctc_type == "PRO") {
						
						echo '<hr>';
				
						if ($rrows['contact_newsletter1'] == 1)
							echo '<p class="card-text"><strong>Newsletter TRA : </strong>SI</p>';
						else
							echo '<p class="card-text"><strong>Newsletter TRA : </strong>NO</p>';
						
						if ($rrows['contact_newsletter2'] == 1)
							echo '<p class="card-text"><strong>Newsletter CUC : </strong>SI</p>';
						else
							echo '<p class="card-text"><strong>Newsletter CUC : </strong>NO</p>';						
						
					}

				?>
	
			</div>
		</div>
	</div>
</div>

<!-- display notes of contact -->

<div id="card_notes">
	<div class="card mt-3">
		<div class="card-header">Notas<input type="button" name="edit_nt" id="edit_nt" value="Editar" class="btn btn-info btn-sm edit_notes float-right"></div>
		<div class="card-body">	
			<div class="row">
				<div class="col">
					<p class="card-text"><?php echo nl2br($rrows['contact_notes']); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- delete contact function -->

<script>
	$(document).ready(function(){
		$('.delete_contact').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar este contacto?<br />Toda la información asociada a este contacto también se eliminará.</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Contacto!",
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
								window.location.replace("dir_contacts");
							})
							.fail(function(){
								bootbox.alert('Error. No se pudo eliminar contacto');
							})
						}
					}
				}
			});
		});
	});
</script>
