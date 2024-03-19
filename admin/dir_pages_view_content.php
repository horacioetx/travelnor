<?php	
		
	$stmt_x = $db->prepare('SELECT * FROM dir_web_pages_content WHERE page_ct_page = :page_ct_page ORDER BY page_ct_order');
	$stmt_x->bindParam(':page_ct_page', $page_id);			
	$stmt_x->execute();	
	
	$numitems = $stmt_x->rowCount();
	
	if ($numitems == 0) {
	
		echo '<div class="alert alert-danger mt-4" role="alert">';
			echo 'No hay contenido en esta página aún!';
		echo '</div>';		
	
	} else {
		
		$output = "";
		$cont1 = 0;
		
		while ($rrows_x = $stmt_x->fetch(PDO::FETCH_ASSOC)) {
			
			/* determine psoition of text and img */
			
			if ($rrows_x['page_ct_side'] == 0)
				$side = "Derecha";
			else
				$side = "Izquierda";			
			
			echo '<div id="' . $rrows_x['page_ct_id']. '">';
			
				$del = '<a data-main="'. $page_id . '" data-org="page_content" data-type="content" data-row-id="' . $rrows_x['page_ct_id'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_subcontact float-right ml-3"><i class="fas fa-trash-alt"></i></a>';
				$edit = '<button type="button" name="edit" value="Editar" subid="' . $rrows_x['page_ct_id'] . '" class="btn btn-info btn-sm edit_data_sub float-right"><i class="fas fa-pencil-alt"></i></button>';
				
				echo '<div class="card easion-card h-100">';

					echo '<div class="card-header d-flex justify-content-between align-items-center">';
						echo '<div class="text-warning font-weight-bold">' . $rrows_x['page_ct_title'] . '</div>';
						echo '<div>' . $del . $edit . '</div>';						
					echo '</div>';
					
					echo '<div class="card-body">';
						echo '<div class="row">';						
						
							echo '<div class="col-12 col-md-7">';
							
								echo '<p class="card-text"><strong>Título : </strong>' . $rrows_x['page_ct_title'] . '</p>';									
								echo '<p class="card-text"><strong>Texto : </strong>' . $rrows_x['page_ct_text'] . '</p>';
								echo '<p class="card-text"><strong>Posición Texto : </strong>' . $side . '</p>';
								echo '<p class="card-text"><strong>Imágen ALT texto : </strong>' . $rrows_x['page_ct_img_alt'] . '</p>';									
								
							echo '</div>';
							

							/* check if img exists */
		
							if ($rrows_x['page_ct_img'] == "") {

								echo '<div class="col-12 col-md-5">';					
									echo '<div class="card easion-card">';
										echo '<div class="card-header d-flex justify-content-between align-items-center">';
											echo '<div><strong>Img</strong></div>';
											echo '<div><a href="#" class="btn btn-info btn-sm float-right mt-1 mt-1" data-val="web_content" data-toggle="modal" data-target="#imgupload"><i class="fas fa-upload"></i></a></div>';
										echo '</div>';
										echo '<div class="card-body align-items-center d-flex justify-content-center">';
											echo '<span><i class="fas fa-camera fa-5x text-secondary"></i></span>';
										echo '</div>';
									echo '</div>';						
								echo '</div>';										
								
							} else {

								echo '<div class="col-12 col-md-5">';						
									echo '<div class="card easion-card">';			
										echo '<div class="card-header d-flex justify-content-between align-items-center">';
											echo '<div><strong>Img</strong></div>';
											echo '<div><a data-org="web_content" data-row-id="' . $page_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_image float-right mt-1"><i class="fas fa-trash-alt"></i></a></div>';
										echo '</div>';
										echo '<div class="card-body">';	
											echo '<img src="https://cucoa.com/images/content/' . $rrows_x['page_ct_img'] . '" class="img-fluid rounded mx-auto d-block" alt="' . $rrows_x['page_ct_title'] . '">';	
										echo '</div>';	

									echo '</div>';				
								echo '</div>';	

							}
			
							
						echo '</div>';
					echo '</div>';

				echo '</div>';
				
			echo '</div>';
			
		}
		
	}
		
?>