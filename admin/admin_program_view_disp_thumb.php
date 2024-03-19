<?php

	/* Thumb image and highlighted texts */
	
	echo '<div class="row mt-3">';		
		
		/* display highlighted texts */
		
		echo '<div class="col-9">';		
			
			echo '<div class="card">';
				echo '<div class="card-header">Highlights<input type="button" name="edit1" id="edit1" value="Editar" class="btn btn-info btn-sm edit_data1 float-right"></div>';
				echo '<div class="card-body text-justify">';
					echo '<span id="highlights">' . $rrows['program_highlights'] . '</span>';
				echo '</div>';
			echo '</div>';
		
			echo '<div class="card mt-3">';
				echo '<div class="card-header">Introducción<input type="button" name="edit2" id="edit2" value="Editar" class="btn btn-info btn-sm edit_data2 float-right"></div>';
				echo '<div class="card-body text-justify">';
					echo '<span id="intro">' . $rrows['program_intro'] . '</span>';
				echo '</div>';
			echo '</div>';		

		echo '</div>';

		/* display thumb images */
						
		if ($rrows['program_thumb_image'] == "") {

			echo '<div class="col-3">';					
				echo '<div class="card">';
					echo '<div class="card-header">Imágen Portada<a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="thumb" data-toggle="modal" data-target="#imgupload">Subir Imágen</a></div>';
					echo '<div class="card-body">';
						echo '<p>No Hay Imagen ' . $k . '</p>';
					echo '</div>';
				echo '</div>';						
			echo '</div>';										
			
		} else {

			echo '<div class="col-3">';						
				echo '<div class="card">';	
					echo '<div class="card-header">Imágen Portada<a data-org="thumbimage" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1">Eliminar</a></div>';
					echo '<div class="card-body">';	
						echo '<img src="https://cucoa.com/images/ourtrips/' . $rrows['program_thumb_image'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rrows['program_thumb_image'] . '">';	
					echo '</div>';	
				echo '</div>';				
			echo '</div>';	

		}
		
	echo '</div>';	

?>