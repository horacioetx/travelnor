<?php

	/* Display General Info */

	$del = '<a data-org="pages" data-row-id="' . $page_id . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_program float-right ml-3" title="Eliminar Página"><i class="fas fa-trash-alt"></i></a>';
	$edit = '<button type="button" name="edit0" id="edit0" value="Edit" class="btn btn-info btn-sm edit_data0 float-right"><i class="fas fa-pencil-alt"></i></button>';

?>

<div class="row">

	<div class="col">

		<div class="card easion-card h-100">

			<div class="card-header d-flex justify-content-between align-items-center">
				<div><strong>Información General</strong></div>
				<div><?php echo $del . $edit; ?></div>
			</div>

			<div class="card-body">	
				<div class="row">
					<div class="col">
						<h6 class="card-title"><strong>Nombre de Página : </strong><?php echo $rrows['page_name']; ?></h6>							
						<h6 class="card-title"><strong>Titulo Tab Navegador : </strong><?php echo $rrows['page_tab']; ?></h6>
						<h6 class="card-title"><strong>Meta Título : </strong><?php echo $rrows['page_meta_title']; ?></h5>
						<h6 class="card-title"><strong>Meta Descripción : </strong><?php echo $rrows['page_meta_description']; ?></h6>
						<h6 class="card-title"><strong>Encabezado h1 : </strong><?php echo $rrows['page_title_h1']; ?></h6>
						<h6 class="card-title"><strong>Texto Intro : </strong><?php echo $rrows['page_main_text']; ?></h6>
						<h6 class="card-title"><strong>Subencabezado h2 : </strong><?php echo $rrows['page_subtitle']; ?></h6>	
						<h6 class="card-title"><strong>Orden menú : </strong><?php echo $rrows['page_order'];; ?></h6>		
						<h6 class="card-title"><strong>Status : </strong><?php echo $status; ?></h6>
					</div>
				</div>
			</div>

		</div>
		
	</div>	

</div>