<?php 

	/* display carrusel images */		

	echo '<div class="card easion-card">';

		echo '<div class="card-header d-flex justify-content-between align-items-center">';
			echo '<div><strong>Imágenes para Carrusel</strong></div>';
			echo '<div><button type="button" name="upimg" id="upimg" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#imgupload" title="Subir imágen carrusel"><i class="fas fa-upload"></i></button></div>';
		echo '</div>';	
		
		echo '<div class="card-body text-justify">';
		
			echo '<div class="row p-1">';	
	
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
							echo '<div class="card easion-card text-center h-75">';
								echo '<div class="card-body align-items-center d-flex justify-content-center">';
									echo '<span><i class="fas fa-camera fa-5x text-secondary"></i></span>';
								echo '</div>';
								echo '<div class="card-footer text-muted">' . $disp_caption . '</div>';
							echo '</div>';	
						echo '</div>';										
						
					} else {

						echo '<div class="col">';					
							echo '<div class="card easion-card text-center h-75 mb-3">';
								echo '<div class="card-body">';
									echo '<img src="https://cucoa.com/images/programs_slides/' . $rrows[$image] . '" class="img-fluid rounded mx-auto d-block" alt=' .$rrows[$image] . '">';
								echo '</div>';
								echo '<div class="card-footer text-muted">' . $disp_caption . '</div>';
							echo '</div>';	
							echo '<div class="text-center">';
								echo '<button type="button" name="caped" value="Editar Pie" capid="' . $imgdel. '" class="btn btn-info btn-sm edit_data_caption mx-1"><i class="fas fa-pencil-alt"></i></button>';
								echo '<a data-org="carrimage" data-row-id="' . $imgdel . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image mx-1"><i class="fas fa-trash-alt"></i></a>';								
							echo '</div>';
						echo '</div>';
						
					}

				}	
			
			echo '</div>';

		echo '</div>';

	echo '</div>';
	
?>