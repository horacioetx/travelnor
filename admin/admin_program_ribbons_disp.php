<?php
				
	$stmt = $db->prepare('SELECT * FROM dir_ribbons ORDER BY ribbon_id');
	$stmt->execute();	
	
	// check if there are members
	
	$numitems = $stmt->rowCount();
	
	if ($numitems == 0) {
	
		echo '<div class="alert alert-danger mt-5" role="alert">';
			echo 'Esta tabla está vacia!';
		echo '</div>';		
	
	} else {
		
		$output = "";
		
		while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
			
			/* links to delete */
			
			$output .= '<div class="col-12 col-md-3">';									
				$output .= '<div class="card m-3">';
					$output .= '<img src="https://cucoa.com/images/ribbons/' . $rrows['ribbon_file'] . '" class="card-img-top" alt="' . $rrows['ribbon_file'] . '">';
					$output .= '<div class="card-body">';
						$output .= '<h5 class="card-title">' . $rrows['ribbon_file'] . '</h5>';		
						$output .=  '<a data-org="ribbons" data-row-id="' . $rrows['ribbon_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1">Eliminar</a>';								
					$output .= '</div>';
				$output .= '</div>';								
			$output .= '</div>';

		}
		
		echo '<div class="container mb-5">';
		
			echo '<p class="text-right">Total No. de Sellos : ' . $numitems . '</p>';						
			
			echo '<div class="row">';
				echo $output;
			echo '</div>';
			
		echo '</div>';
			
	}

?>