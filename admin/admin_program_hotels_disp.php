<?php

	$stmt = $db->prepare('SELECT * FROM dir_programs_hotels WHERE hotel_prog = :hotel_prog ORDER BY hotel_catego');	
	$stmt->execute(array(':hotel_prog' => $prog_id));
	
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
			
			/* retrieve hotel category */
			
			$stmt_ct = $db->prepare('SELECT cat_name FROM dir_hotels_categories WHERE cat_id = :cat_id');	
			$stmt_ct->execute(array(':cat_id' => $rrowi['hotel_catego']));
			$rowcat = $stmt_ct->fetch(PDO::FETCH_ASSOC);
			$disp_catego  = $rowcat['cat_name'];
			
			/* links to edit and delete */
			
			$edit = '<td class="text-center"><input type="button" name="edit" value="Editar" id="' . $rrowi['hotel_id'] . '" class="btn btn-info btn-sm edit_data" /></td>';
			$delete = '<td class="text-center"><a data-org="hotel" data-row-id="' . $rrowi['hotel_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data">Eliminar</a></td>';			
			
			$output .= '<tr>';
				$output .= '<td style="text-align: left;"><strong>' . $rrowi['hotel_name']  . '</strong></td><td style="text-align: left;">' . $rrowi['hotel_city']. '</td><td style="text-align: left;">' . $disp_catego . '</td>' . $edit . $delete;
			$output .= '</tr>';

		}
		
		echo '<p class="text-right">Total : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover">';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col">Hotel</th><th scope="col">Ciudad</th><th scope="col">Categoría</th><th scope="col" class="text-center">Editar</th><th scope="col" class="text-center">Borrar</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>
