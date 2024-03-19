<?php

	/* retrieve rate info */

    $section = 1; // 1 => hotels

	$stmt = $db->prepare('SELECT * FROM dir_programs_gt WHERE gt_section = :gt_section');	
	$stmt->execute(array(':gt_section' => $section));
	
	// check if there are members
	
	$numitems = $stmt->rowCount();
	
	if ($numitems == 0) {
	
		echo '<div class="alert alert-danger mt-3" role="alert">';
			echo 'Esta tabla está vacia!';
		echo '</div>';		
	
	} else {
		
		$output = "";
		$cont1 = 0;
		
		while ($rrowi = $stmt->fetch(PDO::FETCH_ASSOC)) {	
		
			$cont1++;		
			
			/* links to edit and delete */
			
			$edit = '<button type="button" name="edit" value="Editar" id="' . $rrowi['gt_id'] . '" class="btn btn-info btn-sm edit_data mr-3"><i class="fas fa-pencil-alt"></i></button>';
			$delete = '<a data-org="gentxt_hotel" data-row-id="' . $rrowi['gt_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data"><i class="fas fa-trash-alt"></i></a>';	
			
			$output .= '<tr>';
				$output .= '<td style="text-align: left;">' . $rrowi['gt_txt']  . '</td><td style="text-align:center; width:120px;">' . $edit . $delete . '</td>';
			$output .= '</tr>';

		}
		
		echo '<p class="text-right mr-3">Total : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover" >';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col">Texto</th><th scope="col" class="text-center">Acción</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>

