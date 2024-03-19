<?php

	/* open config parameters */
	
	$stmt = $db->prepare('SELECT currency, currency_position FROM config');
	$stmt->execute();
	$row_conf = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* retrieve rate info */

	$stmt = $db->prepare('SELECT * FROM dir_programs_rates WHERE program_rates_program = :program_rate_program ORDER BY program_rate_catego');	
	$stmt->execute(array(':program_rate_program' => $prog_id));
	
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
			$stmt_ct->execute(array(':cat_id' => $rrowi['program_rate_catego']));
			$rowcat = $stmt_ct->fetch(PDO::FETCH_ASSOC);
			$disp_catego  = $rowcat['cat_name'];
			
			/* format rate */
			
			if ($row_conf['currency_position'] == 0)										
				$disp_rate = $row_conf['currency'] . " " . number_format($rrowi['program_rates_rate'],".","",0);
			else
				$disp_rate = number_format($rrowi['program_rates_rate'],0,",",".") . " " . $row_conf['currency'];

			/* determine if rate is featured */
			
			if ($rrowi['program_rates_feature'] == 1)
				$disp_featured = '<span class="text-success">Destacado</span>';
			else
				$disp_featured = "-";
			
			/* links to edit and delete */
			
			$edit = '<button type="button" name="edit" value="Editar" id="' . $rrowi['program_rates_id'] . '" class="btn btn-info btn-sm edit_data mr-3"><i class="fas fa-pencil-alt"></i></button>';
			$delete = '<a data-org="rate" data-row-id="' . $rrowi['program_rates_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_data"><i class="fas fa-trash-alt"></i></a>';		

			$output .= '<tr>';
				$output .= '<td style="text-align: left;"><strong>' . $disp_catego . '</strong><br><span class="text-secondary">' . $rrowi['program_rates_note'] . '</span></td><td class="text-center"><strong>' . $disp_rate . '</strong></td><td class="text-center">' . $disp_featured . '</td><td style="text-align:center; width:120px;">' . $edit . $delete . '</td>';
			$output .= '</tr>';

		}
		
		echo '<p class="text-right mr-3">Total : ' . $cont1 . '</p>';
		
		echo '<table class="table table-bordered table-hover" >';
			echo '<thead class="thead-dark">';
				echo '<tr><th scope="col">Nombre Tarifa</th><th scope="col" class="text-center">Importe</th><th scope="col" class="text-center">Destacado</th><th scope="col" class="text-center">Acción</th></tr>';
			echo '</thead>';
			echo '<tbody>';						
				echo $output;							
			echo '</tbody>';						
		echo '</table>';	

	}
	
?>
