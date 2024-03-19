<?php

	/* Display General Info */

	$del = '<a data-org="program" data-row-id="' . $prog_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_program float-right ml-3">Eliminar</a>';

?>

<div class="row">

	<div class="col-9">

		<div class="card">
			<div class="card-header">Programa : Información General<?php echo $del; ?><input type="button" name="edit0" id="edit0" value="Editar" class="btn btn-info btn-sm edit_data0 float-right"></div>
			<div class="card-body">	
				<div class="row">
					<div class="col-9">
						<h1 class="card-title"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></h1>							
						<h5 class="card-title">Duración : <?php echo str_replace("<br />", " ", $rrows['program_duration']); ?> días</h5>
						<h5 class="card-title">Clasificación 1 : <?php echo str_replace("<br />", " ", $rrows['program_classif']); ?></h5>
						<h5 class="card-title">Clasificación 2 : <?php echo str_replace("<br />", " ", $rrows['program_classif2']); ?></h5>
						<h5 class="card-title">Status : <?php echo $status; ?></h5>
						<h5 class="card-title">Destacado en Home Page : <?php echo $feature; ?></h5>
						<h5 class="card-title">Orden de Despliegue : <?php echo $rrows['program_order']; ?></h5>							
					</div>
					<div class="col-3">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="col-3">

		<div class="card">
			<div class="card-header">Sello<button class="btn btn-info btn-sm float-right mt-2" data-toggle="modal" data-target="#edit_ribbon">Asignar/Cambiar Sello</button></div>
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

<!-- delete full program -->

<script>
	$(document).ready(function(){
		$('.delete_program').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estás seguro que quieres eliminar este programa?<br />Toda la información asociada a este programa también se eliminará.</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Programa!",
				buttons: {
					success: {
						label: "No",
						className: "btn-success",
						callback: function() {
							$('.bootbox').modal('hide');
						}
					},
					danger: {
						label: "Eliminar",
						className: "btn-danger",
						callback: function() {
							$.ajax({
								type: 'POST',
								url: 'delete_records.php',
								data: dataString,
							})
							.done(function(response){
								window.location.replace("admin_programs");
							})
							.fail(function(){
								bootbox.alert('Error. No se pudo eliminar Programa!');
							})
						}
					}
				}
			});
		});
	});
</script>