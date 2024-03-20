<?php

    /* set path to retrieve imgs */

    $path = $conrow['web1_path_img_ribbons'];
				
	$stmt = $db->prepare('SELECT * FROM dir_ribbons ORDER BY ribbon_id');
	$stmt->execute();	
	
	// check if there are items
	
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
				$output .= '<div class="card easion-card">';
					$output .= '<img src= "../images/ribbons/' . $rrows['ribbon_file'] . '" class="card-img-top" alt="' . $rrows['ribbon_file'] . '">';
					$output .= '<div class="card-body">';
						$output .= '<h6 class="card-title">' . $rrows['ribbon_file'] . '</h6>';		
						$output .=  '<a data-org="ribbons" data-row-id="' . $rrows['ribbon_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1"><i class="fas fa-trash-alt"></i></a>';								
					$output .= '</div>';
				$output .= '</div>';								
			$output .= '</div>';

		}
		
		echo '<div class="container mb-5">';
		
			echo '<p class="text-right mr-3">No. de Items : ' . $numitems . '</p>';						
			
			echo '<div class="row">';
				echo $output;
			echo '</div>';
			
		echo '</div>';
			
	}

?>