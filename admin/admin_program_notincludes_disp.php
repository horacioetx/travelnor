<?php

	/* retrieve rate info */

	$stmt = $db->prepare('SELECT * FROM dir_programs_notincluded WHERE prog_inc_prog = :prog_inc_prog ORDER BY prog_inc_id');	
	$stmt->execute(array(':prog_inc_prog' => $prog_id));
	
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
			
			$edit = '<td class="text-center"><input type="button" name="edit" value="Editar" id="' . $rrowi['prog_inc_id'] . '" class="btn btn-info btn-sm edit_data2" /></td>';
			$delete = '<td class="text-center"><a data-org="notincluded" data-row-id="' . $rrowi['prog_inc_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data">Eliminar</a></td>';	
			
			$output .= '<tr>';
				$output .= '<td style="text-align: left;">' . $rrowi['prog_inc_descrip']  . '</td>' . $edit . $delete;
			$output .= '</tr>';

		}
		
		echo '<p class="text-right">Total : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover" >';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col">Descripción</th><th scope="col" class="text-center">Editar</th><th scope="col" class="text-center">Borrar</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>
