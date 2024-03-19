<?php
			
	echo '<div class="row">';
		echo '<div class="col-6">';		
			
			echo '<div class="card text-left card mt-4 mb-4">';
			
				if ($rrows['program_map1'] == "") {
			
					echo '<div class="card-header">Mapa<a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="map" data-toggle="modal" data-target="#imgupload">Subir Mapa</a></div>';
					echo '<div class="card-body">';
							echo '<p>No Hay Mapa</p>';
					echo '</div>';					
						
				} else {
					
					echo '<div class="card-header">Mapa<a data-org="mapimage" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right">Eliminar</a></div>';	
					echo '<div class="card-body">';							
						echo '<img src="https://cucoa.com//images/maps/' . $rrows['program_map1'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rrows['program_map1'] . '">';
					echo '</div>';
						
				}		
			
			echo '</div>';	
				
		echo '</div>';	
	echo '</div>';	

?>