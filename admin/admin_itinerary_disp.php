<?php

	$stmt = $db->prepare('SELECT * FROM programs_itineraries WHERE iti_prog_id = :iti_prog_id ORDER BY iti_prog_day');	
	$stmt->execute(array(':iti_prog_id' => $prog_id));
	
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
			
			/* format some displays */
			
			if ($rrowi['iti_prog_day_back'] == 0) {
				
				$disp_day_back = '';
				$disp_descrip = '<strong>' . $rrowi['iti_prog_title'] . '</strong><br />' . $rrowi['iti_prog_description'];
				
			} else {
				
				$disp_day_back = '=';
				$disp_descrip =  '<span class="text-danger">Igual que el dia anterior</span>';
				
			}			
			
			/* links to edit and delete */
			
			$edit = '<td class="text-center"><input type="button" name="edit" value="Editar" id="' . $rrowi['iti_id'] . '" class="btn btn-info btn-sm edit_data" /></td>';
			$delete = '<td class="text-center"><a data-org="itinerary" data-row-id="' . $rrowi['iti_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data">Eliminar</a></td>';	
			
			$output .= '<tr>';
			$output .= '<td class="text-center"><strong>' . $rrowi['iti_prog_day']  . '</strong></td><td class="text-center">' . $disp_day_back . '</td><td style="text-align: left;">' . $disp_descrip . '</td>' . $edit . $delete;
			$output .= '</tr>';

		}
		
		echo '<p class="text-right">Total Días : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover" >';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col" class="text-center">Día</th><th scope="col" class="text-center">=</th><th scope="col">Título / Descripción</th><th scope="col" class="text-center">Editar</th><th scope="col" class="text-center">Borrar</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>
