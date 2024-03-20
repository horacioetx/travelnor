<?php

	/*** Thumb image and highlighted texts ***/

	/* display highlighted texts */
	
	echo '<div class="col-9">';		
		
		echo '<div class="card easion-card">';

			echo '<div class="card-header d-flex justify-content-between align-items-center">';
				echo '<div><strong>Highlights</strong></div>';
				echo '<div><button type="button" name="edit1" id="edit1" value="Editar" class="btn btn-info btn-sm edit_data1 float-right"><i class="fas fa-pencil-alt"></i></button></div>';
			echo '</div>';

			echo '<div class="card-body text-justify">';
				echo '<span id="highlights">' . $rrows['program_highlights'] . '</span>';
			echo '</div>';

		echo '</div>';
	
		echo '<div class="card easion-card mt-3">';

			echo '<div class="card-header d-flex justify-content-between align-items-center">';
				echo '<div><strong>Introducción</strong></div>';
				echo '<div><button type="button" name="edit2" id="edit2" value="Editar" class="btn btn-info btn-sm edit_data2 float-right"><i class="fas fa-pencil-alt"></i></button></div>';
			echo '</div>';				
			
			echo '<div class="card-body text-justify">';
				echo '<span id="intro">' . $rrows['program_intro'] . '</span>';
			echo '</div>';

		echo '</div>';		

	echo '</div>';

	/* display thumb image */
					
	if ($rrows['program_thumb_image'] == "") {

		echo '<div class="col-6">';					
			echo '<div class="card easion-card">';
				echo '<div class="card-header d-flex justify-content-between align-items-center">';
					echo '<div><strong>Imagen Portada</strong></div>';
					echo '<div><a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="thumb" data-toggle="modal" data-target="#imgupload"><i class="fas fa-upload"></i></a></div>';
				echo '</div>';
				echo '<div class="card-body align-items-center d-flex justify-content-center">';
					echo '<span><i class="fas fa-camera fa-5x text-secondary"></i></span>';
				echo '</div>';
			echo '</div>';						
		echo '</div>';										
		
	} else {

		echo '<div class="col-6">';						
			echo '<div class="card easion-card">';			
				echo '<div class="card-header d-flex justify-content-between align-items-center">';
					echo '<div><strong>Imagen Portada</strong></div>';
					echo '<div><a data-org="thumbimage" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1"><i class="fas fa-trash-alt"></i></a></div>';
				echo '</div>';
				echo '<div class="card-body">';	
					echo '<img src="images/ourtrips/' . $rrows['program_thumb_image'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rrows['program_thumb_image'] . '">';	
				echo '</div>';	

			echo '</div>';				
		echo '</div>';	

	}

?>
