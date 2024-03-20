<?php			
		
	echo '<div class="card easion-card">';
	
		if ($rrows['program_map1'] == "") {

			echo '<div class="card-header d-flex justify-content-between align-items-center">';
				echo '<div><strong>Mapa</strong></div>';
				echo '<div><a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="map" data-toggle="modal" data-target="#imgupload"><i class="fas fa-upload"></i></a></div>';
			echo '</div>';

			echo '<div class="card-body align-items-center d-flex justify-content-center">';
				echo '<span><i class="fas fa-map-marked-alt fa-5x text-secondary"></i></span>';
			echo '</div>';					
				
		} else {

			echo '<div class="card-header d-flex justify-content-between align-items-center">';
				echo '<div><strong>Mapa</strong></div>';
				echo '<div><a data-org="mapimage" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right"><i class="fas fa-trash-alt"></i></a></div>';
			echo '</div>';
			
			echo '<div class="card-body">';							
				echo '<img src="../images/maps/' . $rrows['program_map1'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rrows['program_map1'] . '">';
			echo '</div>';
				
		}		
	
	echo '</div>';				

?>