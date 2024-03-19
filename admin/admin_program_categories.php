<?php
	
	/* admin_programs_categories.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Directorio de Categorías';	
	else	
		$title = 'Directorio de Categorías';

?>

<!doctype html>
<html lang="en">

	<head>
	
		<!-- meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $title; ?></title>
		
		<!-- favicon -->
		


		<!-- fonts -->
		
		<link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">

		<!-- Custom CSS -->
		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">		
		<link rel="stylesheet" href="css/easion.css">	
		
		<!-- title -->
		
		<title><?php echo $title; ?></title>
		
	</head>

	<body>
	
		<div class="dash">
		
			<!-- navbar -->

			<?php include ("navbar.php"); ?>

			<!-- center body -->
			
			<div class="dash-app">
			
				<!-- header bar -->
				
				<?php include ("header_bar.php"); ?>
				
				<!-- breadcrumb -->
				
				<nav class="bg-light" aria-label="breadcrumb">
					<ol class="breadcrumb">								
						<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Directorio de Categorías</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
					
						<h5><strong>Directorio de Categorías</strong></h5>			
						
						<div class="row dash-row mt-4">							
					
							<div class="col">								
					
								<div class="container-fluid border-top border-bottom pl-0 py-3 mb-4">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_item">Agregar Nueva Categoría</button>	
								</div>
												
								<?php
						
									$stmt = $db->prepare('SELECT * FROM dir_hotels_categories ORDER BY cat_order');
									$stmt->execute();	
									
									$numitems = $stmt->rowCount();
									
									if ($numitems == 0) {
									
										echo '<div class="alert alert-danger mt-5" role="alert">';
											echo 'This table is empty!';
										echo '</div>';		
									
									} else {
										
										$output = "";
										
										while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
											
											/* links to edit and delete */
											
											$edit = '<button type="button" name="edit" value="Edit" id="' . $rrows['cat_id'] . '" class="btn btn-info btn-sm edit_data"><i class="fas fa-pencil-alt"></i></button>';
                                            $del = '<a data-org="hotcat" data-row-id="' . $rrows['cat_id'] . '" data-name="' .  $rrows['cat_name'] . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_item ml-3"><i class="fas fa-trash-alt"></i></a>';
										
											$output .= '<tr>';
												$output .= '<td>' . $rrows['cat_name'] . '</td><td class="text-center">' . $rrows['cat_order'] . '</td><td class="text-center" style="width:120px;">' . $edit . $del . '</td>';
											$output .= '</tr>';

										}
										
										if (isset($_GET['msgok'])) {
											echo '<div class="alert alert-success" role="alert"><strong><i class="far fa-check-circle fa-lg"></i> Item eliminado satisfactoriamente!</strong></div>';
										}
										
										echo '<table id="table_list" class="table table-bordered table-hover">';
											echo '<thead class="thead-dark">';
												echo '<tr><th scope="col" class="text-center">Categoría</th><th scope="col" class="text-center">Orden</th><th scope="col" class="text-center">Acción</th></tr>';
											echo '</thead>';
											echo '<tbody>';						
												echo $output;							
											echo '</tbody>';						
										echo '</table>';
											
									}
								
								?>
						
							</div>
							
						</div>

					</div>	
					
				</main>
				
			</div>
			
		</div>
		
		<!-- MODALS -->
		
		<!-- Add New item -->
		
		<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar Categoría</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_add" method="post">	
					
						<div class="modal-body bg-light">	
						
							<div id="errmsg"></div>

							<div class="form-row">								
								<div class="col">
									<label for="cat_name" class="col-form-label">Nombre Categoría:</label>
									<input type="text" id="cat_name" name="cat_name" class="form-control" required>
								</div>
							</div>	

                            <div class="form-row">								
								<div class="col">
									<label for="cat_order" class="col-form-label">Orden de Despliegue:</label>
									<input type="number" id="cat_order" name="cat_order" class="form-control" value="0" required>
								</div>
							</div>	

							<div class="modal-footer border-0">							
								<input type="submit" class="btn btn-sm btn-primary" id="register" name="register" value="Guardar">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Edit item -->
		
		<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user mr-3"></i>Editar Categoría</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edit" method="post">	
					
						<div class="modal-body bg-light">	
						
							<div id="e_errmsg"></div>
															
                            <div class="form-row">								
								<div class="col">
									<label for="e_cat_name" class="col-form-label">Nombre Categoría:</label>
									<input type="text" id="e_cat_name" name="e_cat_name" class="form-control" required>
								</div>
							</div>	

                            <div class="form-row">								
								<div class="col">
									<label for="e_cat_order" class="col-form-label">Orden de Despliegue:</label>
									<input type="number" id="e_cat_order" name="e_cat_order" class="form-control" value="0" required>
								</div>
							</div>	

							<div class="modal-footer border-0">	
								<input type="hidden" id="e_cat_id" name="e_cat_id">
								<input type="submit" class="btn btn-sm btn-primary" id="edit" name="edit" value="Guardar">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- js -->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>
		
		<!-- datatables -->		
		
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>	

		<script>
			$(document).ready(function() {
				$('#table_list').DataTable();
			});
		</script>
		
		<script>
			$('#table_list').DataTable({
				language: {	search: "", searchPlaceholder: "Buscar...",
							sLengthMenu: "Mostrar _MENU_"},
			});
		</script>        
		
		<!-- send form_add form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_add']").submit(function(){
					$.ajax({
						url : 'admin_program_categories_add.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#errmsg").html(data.msg);														
							} else {
								window.location='admin_program_categories.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>
		
		<!-- populate form_edit form -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_data', function(){  
					var id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_categories.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){ 
							$('#e_cat_id').val(data.cat_id); 
							$('#e_cat_name').val(data.cat_name); 
							$('#e_cat_order').val(data.cat_order);  
							$('#edit_item').modal('show');  
						}  
					});  
				});  		
			});  
		 </script>
		 
		<!-- send form_edit form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_edit']").submit(function(){
					$.ajax({
						url : 'admin_program_categories_edit.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#e_errmsg").html(data.msg);														
							} else {
								window.location='admin_program_categories.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>
		
		<!-- delete items -->

		<script>
			$(document).ready(function(){
                $('#table_list').on('click','.delete_item',function (e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var roworg = $(this).attr('data-org');
					var rowname = $(this).attr('data-name');
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
					bootbox.dialog({
						message: "<div class='alert alert-danger text-center' role='alert'><strong>Estas seguro que quieres eliminar este item?<br><span class='text-primary'>" + rowname + "</span><br>Toda la información asociada a este item también se eliminará!</strong></div>",
						title: "<i class='fas fa-trash-alt text-danger'></i> Eliminar!",
						buttons: {
							success: {
								label: "No",
								className: "btn-success btn-sm",
								callback: function() {
									$('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Delete",
								className: "btn-danger btn-sm",
								callback: function() {
									$.ajax({
										type: 'POST',
										url: 'delete_records.php',
										data: dataString,
									})
									.done(function(response){
										window.location.replace("admin_program_categories?msgok=1");
									})
									.fail(function(){
										bootbox.alert('Error. The deleted process failed! Check with the system administrator.');
									})
								}
							}
						}
					});
				});
			});
		</script>
		
	</body>	

</html>