<?php
	
	/* dir_pages.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Directorio de Páginas Web';	
	else	
		$title = 'Directorio de Páginas Web';

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
						<li class="breadcrumb-item active" aria-current="page">Directorio de Páginas Web</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
					
						<h5><strong>Directorio de Páginas Web</strong></h5>			
						
						<div class="row dash-row mt-4">							
					
							<div class="col">								
					
								<div class="container-fluid border-top border-bottom pl-0 py-3 mb-4">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_item">Agregar Nueva Página Web</button>	
								</div>
												
								<?php

                                    $stmt = $db->prepare('SELECT page_id, page_order, page_name, page_status FROM dir_web_pages ORDER BY page_order');
                                    $stmt->execute();	

                                    // check if there are members

                                    $numitems = $stmt->rowCount();

                                    if ($numitems == 0) {

                                        echo '<div class="alert alert-danger mt-5" role="alert">';
                                            echo 'Esta tabla está vacia!';
                                        echo '</div>';		

                                    } else {
                                        
                                        $output = "";
                                        
                                        while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
                                        
                                            /* check attendance */
                                            
                                            if ($rrows['page_status'] == 0)
                                                $disp_status = '<span style="color:green;">Activa</span>';
                                            else 
                                                $disp_status = '<span style="color:red;">Inactiva</span>';
                                            
                                            /* links to edit and delete */
                                            
                                            $view = '<td style="text-align:center; width:120px;"><form method="post" action="dir_pages_view"><button type="submit" name="additi" value="Ver" class="btn btn-success btn-sm delete_data"><i class="fas fa-search-plus"></i></button><input type="hidden" name="pagid" value="' . $rrows['page_id'] . '"></form></td>';
                                            
                                            $output .= '<tr>';
                                                $output .= '<td><strong>' . str_replace("<br />", " ", $rrows['page_name']) . '</strong></td><td style="text-align: center;">' . $disp_status . '</td>' . $view;
                                            $output .= '</tr>';

                                        }                                        
             
                                        echo '<table id="table_list" class="table table-bordered table-hover">';
                                            echo '<thead class="thead-dark">';
                                                echo '<tr><th scope="col">Nombre de Página</th><th scope="col" style="text-align: center;">Status</th><th scope="col" style="text-align: center;">Ver</th></tr>';
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
		
		<!-- Add new page modal -->
		
		<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="far fa-window-maximize mr-3"></i>Agregar Página Web</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_new_prog" method="post">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="page_name" class="col-form-label">Nombre de Página Web:</label>
									<input type="text" id="page_name" name="page_name" class="form-control" value="" >
								</div>
							</div>				
						
							<div class="form-row">
								<div class="col">
									<label for="page_status" class="col-form-label">Status:</label>
									<select class="custom-select mr-sm-2" id="page_status" name="page_status">
										<option value="0">Página Activa</option>
										<option value="1" selected>Página Inactiva</option>
									</select>
								</div>
							</div>
							
							<div class="modal-footer">
							
								<button type="submit" class="btn btn-primary btn-sm" id="editar" name="editar" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
						
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
		
        <!-- send form_new form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_new_prog']").submit(function(){
					$.ajax({
						url : 'dir_pages_add.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.stat === 1) {
								$("#errmsg").html(data.msg);														
							} else {
								window.location='dir_pages_view.php?pagid=' + data.lastid + '&msg=' + data.msg 								
							}	
						}
					});
					return false;
				});
			});			
		</script>	
		
	</body>	

</html>