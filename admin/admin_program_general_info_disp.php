<?php

	/* Display General Info */

	$del = '<a data-org="program" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_program float-right ml-3" title="Delete Contact"><i class="fas fa-trash-alt"></i></a>';
	$edit = '<button type="button" name="edit0" id="edit0" value="Edit" class="btn btn-info btn-sm edit_data0 float-right"><i class="fas fa-pencil-alt"></i></button>';

?>

<div class="row">

	<div class="col-9">

		<div class="card easion-card h-100">

			<div class="card-header d-flex justify-content-between align-items-center">
				<div><strong>Información General</strong></div>
				<div><?php echo $del . $edit; ?></div>
			</div>

			<div class="card-body">	
				<div class="row">
					<div class="col">
						<h1 class="card-title"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></h1>							
						<h5 class="card-title">Duración : <?php echo str_replace("<br />", " ", $rrows['program_duration']); ?> días</h5>
						<h5 class="card-title">Clasificación 1 : <?php echo str_replace("<br />", " ", $rrows['program_classif']); ?></h5>
						<h5 class="card-title">Clasificación 2 : <?php echo str_replace("<br />", " ", $rrows['program_classif2']); ?></h5>
						<h5 class="card-title">Status : <?php echo $status; ?></h5>
						<h5 class="card-title">Destacado en Home Page : <?php echo $feature; ?></h5>
						<h5 class="card-title">Orden de Despliegue : <?php echo $rrows['program_order']; ?></h5>							
					</div>
				</div>
			</div>

		</div>
		
	</div>
	
	<div class="col-3">

		<div class="card easion-card h-100">
			<div class="card-header d-flex justify-content-between align-items-center"><strong>Sello</strong><button class="btn btn-info btn-sm float-right mt-2" data-toggle="modal" data-target="#edit_ribbon" title="Cambiar/Asignar Sello"><i class="fas fa-stamp"></i></button></div>
			<div class="card-body text-center">	

				<?php 

					if ($rrows['program_ribbon'] > 0) {		

						/* check if program has ribbon */						
									
						$stmt_rib = $db->prepare('SELECT ribbon_file FROM dir_ribbons WHERE ribbon_id = :ribbon_id');
						$stmt_rib->execute(array(':ribbon_id' => $rrows['program_ribbon']));
						$rowrib = $stmt_rib->fetch();
						
						echo '<img src="' . $row_conf1['web1_path_img_ribbons'] . $rowrib['ribbon_file'] . '" class="img-thumbnail">';		
						
					} else {
						
						echo '<img src="' . $row_conf1['web1_path_img_ribbons'] . 'empty_ribbon.png" class="img-thumbnail">';
						
					}
				
				?>

			</div>					
		</div>
		
	</div>
	
</div>
