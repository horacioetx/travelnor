<?php

	/* retrieve rate info */

	$stmt = $db->prepare('SELECT * FROM dir_programs_included WHERE prog_inc_prog = :prog_inc_prog ORDER BY prog_inc_type, prog_inc_id');	
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
			
			/* determine if inclusion is top (special) */
			
			if ($rrowi['prog_inc_type'] == 1)
				$disp_special = '<span class="text-warning">Especial</span>';
			else
				$disp_special = '<span class="text-secondary">Regular</span>';
			
			/* links to edit and delete */
			
			$edit = '<button type="button" name="edit" value="Editar" id="' . $rrowi['prog_inc_id'] . '" class="btn btn-info btn-sm edit_data mr-3"><i class="fas fa-pencil-alt"></i></button>';
			$delete = '<a data-org="included" data-row-id="' . $rrowi['prog_inc_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data"><i class="fas fa-trash-alt"></i></a>';	
			
			$output .= '<tr>';
				$output .= '<td>' . $rrowi['prog_inc_descrip']  . '</td><td class="text-center">' . $disp_special . '</td><td style="text-align:center; width:120px;">' . $edit . $delete . '</td>';

		}
		
		echo '<p class="text-right mr-3">Total : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover" >';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col">Descripción</th><th scope="col" class="text-center">Tipo</th><th scope="col" class="text-center">Acción</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>
