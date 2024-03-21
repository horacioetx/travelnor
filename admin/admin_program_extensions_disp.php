<?php

	/* retrieve exension info*/
	
	$stmt_ext = $db->prepare('SELECT * FROM dir_programs_extensions WHERE ext_program = :ext_program');	
	$stmt_ext->execute(array(':ext_program' => $prog_id));	
	
	// check if there are members
	
	$numitems = $stmt_ext->rowCount();
	
	if ($numitems == 0) {
		
		echo '<button type="button" class="btn btn-success btn-sm mt-2" data-toggle="modal" data-target="#new">Agregar Extensión</button>';
	
		echo '<div class="alert alert-danger mt-3" role="alert">';
			echo 'Este programa no tiene Extensión!';
		echo '</div>';		
	
	} else {
	
		$rows_ext = $stmt_ext->fetch(PDO::FETCH_ASSOC);		
	
		if ($rows_ext['ext_status'] == 0)	
			$status = '<span class="text-success">Activo</span>';
		else
			$status = '<span class="text-danger">Inactivo</span>';		

		/* format rate */
			
		if ($conrow['currency_position'] == 0)										
			$disp_rate = $conrow['currency'] . " " . number_format($rows_ext['ext_cost'],".","",0);
		else
			$disp_rate = number_format($rows_ext['ext_cost'],0,",",".") . " " . $conrow['currency'];

		
		echo '<div class="row mt-3">';		
			
			/* display extension info */
			
			echo '<div class="col-9">';					
				
				$del = '<a data-org="extension" data-row-id="' . $rows_ext['ext_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_extension float-right ml-3"><i class="fas fa-trash-alt"></i></a>';
				$edit = '<button type="button" name="edit1" id="' . $rows_ext['ext_id'] . '" value="Editar" class="btn btn-info btn-sm edit_ext float-right"><i class="fas fa-pencil-alt"></i></button>';

				/* general extension info */

				echo '<div class="card easion-card">';

					echo '<div class="card-header d-flex justify-content-between align-items-center">';
						echo '<div><strong>Información Extensión</strong></div>';
						echo '<div>' . $del . $edit . '</div>';						
					echo '</div>';
					
					echo '<div class="card-body text-justify">';							
						echo '<h5 class="card-title">Nombre Extensión : <span class="text-success">' . $rows_ext['ext_name'] . '</span></h5>';
						echo '<h5 class="card-title">No. de Noches : ' . $rows_ext['ext_nites'] . '</h5>';
						echo '<h5 class="card-title">Hotel : ' . $rows_ext['ext_hotel'] . '</h5>';
						echo '<h5 class="card-title">Precio : ' . $disp_rate . '</h5>';
						echo '<h5 class="card-title">Status : ' . $status . '</h5>';								
					echo '</div>';

				echo '</div>';

				/* notes */
			
				echo '<div class="card easion-card mt-3">';
					echo '<div class="card-header d-flex justify-content-between align-items-center"><strong>Notas</strong></div>';
					echo '<div class="card-body text-justify">';
					
						$disp_notes = str_replace( "\n", '<br />', $rows_ext['ext_notes'] );					
						echo '<span id="intro">' . nl2br($disp_notes) . '</span>';

					echo '</div>';
				echo '</div>';		

			echo '</div>';

			/* display thumb images */
							
			if ($rows_ext['ext_image'] == "") {

				echo '<div class="col-3">';					
					echo '<div class="card easion-card">';
						echo '<div class="card-header d-flex justify-content-between align-items-center">';
							echo '<div><strong>Imagen</strong></div>';
							echo '<div><a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="ext" data-row-id="' . $rows_ext['ext_id'] . '" data-toggle="modal" data-target="#imgupload"><i class="fas fa-upload"></i></a></div>';
						echo '</div>';						
						echo '<div class="card-body align-items-center d-flex justify-content-center">';
							echo '<span><i class="fas fa-camera fa-5x text-secondary"></i></span>';
						echo '</div>';
					echo '</div>';						
				echo '</div>';										
				
			} else {

				echo '<div class="col-3">';						
					echo '<div class="card easion-card">';	
						echo '<div class="card-header d-flex justify-content-between align-items-center">';
							echo '<div><strong>Imagen</strong></div>';
							echo '<div><a data-org="ext" data-row-id="' . $rows_ext['ext_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1"><i class="fas fa-trash-alt"></i></a></a></div>';
						echo '</div>';						
						echo '<div class="card-body">';	
							echo '<img src="../images/extensions/' . $rows_ext['ext_image'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rows_ext['ext_name'] . '">';	
						echo '</div>';	
					echo '</div>';				
				echo '</div>';	

			}
			
		echo '</div>';	
		
	}
	
?>
