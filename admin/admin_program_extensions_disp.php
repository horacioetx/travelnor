<?php

	/* retrieve exension info*/
	
	$stmt_ext = $db->prepare('SELECT * FROM dir_programs_extensions WHERE ext_program = :ext_program');	
	$stmt_ext->execute(array(':ext_program' => $prog_id));	
	
	// check if there are members
	
	$numitems = $stmt_ext->rowCount();
	
	if ($numitems == 0) {
		
		echo '<button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#new">Agregar Extensión</button>';
	
		echo '<div class="alert alert-danger mt-3" role="alert">';
			echo 'Este programa no tiene Extensión!';
		echo '</div>';		
	
	} else {
	
		$rows_ext = $stmt_ext->fetch(PDO::FETCH_ASSOC);		
	
		if ($rows_ext['ext_status'] == 0)	
			$status = '<span class="text-success">Activo</span>';
		else
			$status = '<span class="text-danger">Inactivo</span>';		
		
		echo '<div class="row mt-3">';		
			
			/* display extension info */
			
			echo '<div class="col-9">';					
				
				$del = '<a data-org="extension" data-row-id="' . $rows_ext['ext_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_extension float-right ml-3">Eliminar</a>';
				
				echo '<div class="card">';
					echo '<div class="card-header">Información Extension' . $del . '<input type="button" name="edit1" id="' . $rows_ext['ext_id'] . '" value="Editar" class="btn btn-info btn-sm edit_ext float-right"></div>';
					echo '<div class="card-body text-justify">';							
						echo '<h5 class="card-title">Nombre Extensión : <span class="text-success">' . $rows_ext['ext_name'] . '</span></h5>';
						echo '<h5 class="card-title">No. de Noches : ' . $rows_ext['ext_nites'] . '</h5>';
						echo '<h5 class="card-title">Hotel : ' . $rows_ext['ext_hotel'] . '</h5>';
						echo '<h5 class="card-title">Precio : ' . $rows_ext['ext_cost'] . '</h5>';
						echo '<h5 class="card-title">Status : ' . $status . '</h5>';								
					echo '</div>';
				echo '</div>';
			
				echo '<div class="card mt-3">';
					echo '<div class="card-header">Notas</div>';
					echo '<div class="card-body text-justify">';
					
						$disp_notes = str_replace( "\n", '<br />', $rows_ext['ext_notes'] );
					
						echo '<span id="intro">' . nl2br($disp_notes) . '</span>';
					echo '</div>';
				echo '</div>';		

			echo '</div>';

			/* display thumb images */
							
			if ($rows_ext['ext_image'] == "") {

				echo '<div class="col-3">';					
					echo '<div class="card">';
						echo '<div class="card-header">Imágen<a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="ext" data-row-id="' . $rows_ext['ext_id'] . '" data-toggle="modal" data-target="#imgupload">Subir Imágen</a></div>';
						echo '<div class="card-body">';
							echo '<p>No Hay Imagen</p>';
						echo '</div>';
					echo '</div>';						
				echo '</div>';										
				
			} else {

				echo '<div class="col-3">';						
					echo '<div class="card">';	
						echo '<div class="card-header">Imágen<a data-org="ext" data-row-id="' . $rows_ext['ext_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1">Eliminar</a></div>';
						echo '<div class="card-body">';	
							echo '<img src="https://cucoa.com/images/extensions/' . $rows_ext['ext_image'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rows_ext['ext_name'] . '">';	
						echo '</div>';	
					echo '</div>';				
				echo '</div>';	

			}
			
		echo '</div>';	
		
	}
	
?>

<!-- delete full program -->

<script>
	$(document).ready(function(){
		$('.delete_extension').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estás seguro que quieres eliminar esta extensión?<br />Toda la información asociada a esta extensión también se eliminará.</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Extensión!",
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
								$("#disp_extension").html(response);										
								bootbox.alert('<div class="alert alert-success" role="alert">Extensión eliminada satisfactoriamente!</div>');	
							})
							.fail(function(){
								bootbox.alert('Error. No se pudo eliminar Programa!');
							})
						}
					}
				}
			});
		});
	});
</script>