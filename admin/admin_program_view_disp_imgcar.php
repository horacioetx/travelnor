<?php 

	/* display carrusel images */	
	
	echo '<div class="card mt-4 mb-4">';
		echo '<div class="card-header">Imágenes para Carrusel<button type="button" name="upimg" id="upimg" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#imgupload">Subir Foto</button></div>';
		echo '<div class="row p-3">';	
	
			for ($k=1; $k<=4; $k++) {
											
				$image = 'program_banner' . $k;
				$caption = 'program_banner_cap' . $k;
				$imgdel = $k;	
				
				if ($rrows[$caption] == "")
					$disp_caption = "- x -";
				else
					$disp_caption = $rrows[$caption];

				/* check if image exists */
				
				if ($rrows[$image] == "") {
					
					echo '<div class="col">';					
						echo '<div class="card text-center">';
							echo '<div class="card-body">';
								echo '<p>No Hay Imagen ' . $k . '</p>';
							echo '</div>';
							echo '<div class="card-footer text-muted">' . $disp_caption . '</div>';
						echo '</div>';	
					echo '</div>';										
					
				} else {

					echo '<div class="col">';					
						echo '<div class="card text-center">';
							echo '<div class="card-body">';
								echo '<img src="https://cucoa.com/images/programs_slides/' . $rrows[$image] . '" class="img-fluid rounded mx-auto d-block" alt=' .$rrows[$image] . '">';
							echo '</div>';
							echo '<div class="card-footer text-muted">' . $disp_caption . '</div>';
						echo '</div>';	
						echo '<div class="mt-1">';
							echo '<a data-org="carrimage" data-row-id="' . $imgdel . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right">Eliminar</a>';							
							echo '<input type="button" name="caped" value="Editar Pie" capid="' . $imgdel. '" class="btn btn-info btn-sm edit_data_caption float-right mr-2">';							
						echo '</div>';
					echo '</div>';
					
				}

			}			

		echo '</div>';
	echo '</div>';
	
?>