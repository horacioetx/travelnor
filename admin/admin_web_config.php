<?php
	
	/* admin_web_config.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' Configuración General Website';	
	else	
		$title = 'Configuración General Website';
		
	$active_page = "C1";

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
						<li class="breadcrumb-item active" aria-current="page">Configuración General Website</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
						
						<?php include("admin_web_config_subnavbar.php"); ?>

						<div class="row dash-row mt-4">	
						
							<div class="col-12">
						
								<div class="card easion-card">
								
									<div class="card-header d-flex justify-content-between align-items-center">
										<div class="easion-card-title"> Configuración Inicial </div>
										<button type="button" name="edit0" id="edit0" value="Edit" class="btn btn-info btn-sm edit_data0 float-right"><i class="fas fa-pencil-alt"></i></button>
									</div>
									
									<div class="card-body">	
										<div class="row">
											<div class="col">

												<h5><strong>Comunicación</h5>
                                                											
												<h6 class="card-title">Empresa : <span class="text-info"><?php echo $conrow['company_name']; ?></span></h6>													
												<h6 class="card-title">Website URL : <span class="text-info"><?php echo $conrow['company_website']; ?></span></h6>
												<h6 class="card-title">Email : <span class="text-info"><?php echo $conrow['company_email']; ?></span></h6>
												
												<hr>
                                                
                                                <?php

													/* define currency position for main currency */

													if ($conrow['currency_position'] == 0)
														$disp_currency = '<span class="text-success"><strong>' . $conrow['currency'] . '</strong></span>' . ' 999.99';
													else
														$disp_currency = '999.99 ' . '<span class="text-success"><strong>' . $conrow['currency'] . '</strong></sapn>';

													/* define currency position for secondary currency */

													if ($conrow['currency_2_position'] == 0)
														$disp_currency2 = '<span class="text-success"><strong>' . $conrow['currency_2'] . '</strong></span>' . ' 999.99';
													else
														$disp_currency2 = '999.99 ' . '<span class="text-success"><strong>' . $conrow['currency_2'] . '</strong></sapn>';

													/* define currency 2 status */

													if ($conrow['currency_2_status'] == 0)
														$disp_currency2_stat = '<span class="text-success"><strong>Activo</strong></span>';
													else
														$disp_currency2_stat = '<span class="text-danger"><strong>Inactivo</strong></sapn>';

												?>
 
 												<h5><strong>Moneda Principal</h5>
												<h6 class="card-title">Moneda : <span class="text-info"><?php echo $conrow['currency_main']; ?></span></h6>
												<h6 class="card-title">Símbolo : <span class="text-info"><?php echo $conrow['currency']; ?></span></h6>
												<h6 class="card-title">Posición Símbolo : <span class="text-info"><?php echo $disp_currency; ?></span></h6>
												<h5><strong>Moneda Secundaria</h5>
												<h6 class="card-title">Moneda : <span class="text-info"><?php echo $conrow['currency_secondary']; ?></span></h6>
												<h6 class="card-title">Símbolo : <span class="text-info"><?php echo $conrow['currency_2']; ?></span></h6>
												<h6 class="card-title">Posición Símbolo  : <span class="text-info"><?php echo $disp_currency2; ?></span></h6>
												<h6 class="card-title">Status  : <span class="text-info"><?php echo $disp_currency2_stat; ?></span></h6>
												
												<hr>
												
												<h5><strong>Límites</h5>
												<h6 class="card-title">No. de días Máximo por Programa : <span class="text-info"><?php echo $conrow['maxdays']; ?> días</span></h6>

											</div>
										</div>
									</div>
									
								</div>
							
							</div>
						
						</div>						

					</div>	
					
				</main>
				
			</div>
			
		</div>

		<!-- MODALS -->

        <!-- modal to edit General Info -->
		
		<div class="modal fade" id="edit_general" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">	

					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Configuración Inicial</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>	
								
					<form id="form_edit" method="post" autocomplete="off">						
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="company_name" class="col-form-label">Empresa :</label>
									<input type="text" id="company_name" name="company_name" class="form-control" value="">
								</div>
							</div>	

							<div class="form-row">								
								<div class="col mt-2">
									<label for="company_website" class="col-form-label">Website (ej. website.com) :</label>
									<input type="text" id="company_website" name="company_website" class="form-control" value="">
								</div>
							</div>	

							<div class="form-row">								
								<div class="col mt-2">
									<label for="company_email" class="col-form-label">Email de Conectividad :</label>
									<input type="email" id="company_email" name="company_email" class="form-control" value="">
								</div>
							</div>	

							<div class="form-row mt-3">								
								<div class="col mt-2">
									<h5><strong>Monedas de Operación</strong></h5>
								</div>
							</div>	

							<div class="form-group row mt-1 pt-1 pb-3 border-top border-bottom bg-light">							

								<div class="col">
									<label for="currency_main" class="col-form-label mt-1">Principal : </label>
									<select class="custom-select mr-sm-2 currency-selector" id="currency_main" name="currency_main" >
										<option value="USD" data-symbol="$">USD</option>
										<option value="EUR" data-symbol="€">EUR</option>
										<option value="GBP" data-symbol="£">GBP</option>
										<option value="JPY" data-symbol="¥">JPY</option>
										<option value="CAD" data-symbol="$">CAD</option>
										<option value="AUD" data-symbol="$">AUD</option>
										<option value="MXN" data-symbol="$">MXN</option>
									</select>
								</div>

								<div class="col text-left">
									<label class="col-form-label mt-1">Símbolo : </label>
									<div class="border p-1 text-center w-100">
										<h5 class="ml-2 pt-2" style="line-height: 12px;"><span id="currency-symbol_1"></span></h5>
									</div>
								</div>

								<div class="col">
									<label for="currency_position" class="col-form-label mt-1">Posicion : </label>
									<select class="custom-select mr-sm-2" id="currency_position" name="currency_position" >
										<option value="0" data-symbol="$">$999</option>
										<option value="1" data-symbol="€">999$</option>
									</select>
								</div>

								<div class="col text-left">

								</div>

							</div>	

							<div class="form-group row mt-n3 pt-1 pb-3 border-bottom bg-light">

								<div class="col">

									<label for="currency_secondary" class="col-form-label mt-1">Secundaria : </label>
									<select class="custom-select mr-sm-2 currency-selector2" id="currency_secondary" name="currency_secondary" >
										<option value="USD" data-symbol="$">USD</option>
										<option value="EUR" data-symbol="€">EUR</option>
										<option value="GBP" data-symbol="£">GBP</option>
										<option value="JPY" data-symbol="¥">JPY</option>
										<option value="CAD" data-symbol="$">CAD</option>
										<option value="AUD" data-symbol="$">AUD</option>
										<option value="MXN" data-symbol="$">MXN</option>
									</select>																

								</div>

								<div class="col text-left">
									<label class="col-form-label mt-1">Símbolo : </label>
									<div class="border p-1 text-center w-100">
									<h5 class="ml-2 pt-2" style="line-height: 12px;"><span id="currency-symbol_2"></span></h5>
									</div>
								</div>

								<div class="col">
									<label for="currency_2_position" class="col-form-label mt-1">Posicion : </label>
									<select class="custom-select mr-sm-2" id="currency_2_position" name="currency_2_position" >
										<option value="0" data-symbol="$">$999</option>
										<option value="1" data-symbol="€">999$</option>
									</select>
								</div>

								<div class="col text-left">
									<label for="currency_2_status" class="col-form-label mt-1">Status :</label>
									<select class="custom-select mr-sm-2" id="currency_2_status" name="currency_2_status">
										<option value="0" class="text-success">Activo</option>
										<option value="1" class="text-danger">Inactivo</option>
									</select>	
								</div>

							</div>		

							<div class="form-row">								
								<div class="col">
									<label for="maxdays" class="col-form-label">No. de días Máximo por Programa :</label>
									<input type="number" id="maxdays" name="maxdays" class="form-control w-50" step="1" value="1">
								</div>
							</div>	

							<div class="modal-footer mt-4">		
								<input type="hidden" name="currency_symbol2" id="currency_symbol2">	
								<input type="hidden" name="currency_symbol1" id="currency_symbol1">					
								<button type="submit" class="btn btn-primary btn-sm" id="editar0" name="editar0" value="edit">Guardar</button>
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

		<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>

		<!-- currency selectors -->

		<script>
			function updateSymbol(e){
				var selected = $(".currency-selector option:selected");
				$("#currency-symbol_1").text(selected.data("symbol"));
				$("#currency_symbol1").val(selected.data("symbol"))
			}
			$(".currency-selector").on("change", updateSymbol)
			updateSymbol()
		</script>

		<script>
			function updateSymbol2(e){
				var selected = $(".currency-selector2 option:selected");
				$("#currency-symbol_2").text(selected.data("symbol"));
				$("#currency_symbol2").val(selected.data("symbol"))
			}
			$(".currency-selector2").on("change", updateSymbol2)
			updateSymbol2()
		</script>

		<!-- Edit info -->

		<script>		
			$(document).ready(function(){  
				$('#edit0').click(function() {
					$('#edit0').val("Editar");
					$('#form_edit')[0].reset();
				});
				$(document).on('click', '.edit_data0', function(){  
					$.ajax({  
						url:"fetch_config.php",  
						method:"POST",  
						dataType:"json",  
						success:function(data){  
							$('#company_name').val(data.company_name);  
							$('#company_website').val(data.company_website);  
							$('#company_email').val(data.company_email);							
							$('#currency_main').val(data.currency_main); 
							$('#currency-symbol_1').html(data.currency);
							$('#currency_symbol1').val(data.currency); 
							$('#currency_position').val(data.currency_position); 
							$('#currency_secondary').val(data.currency_secondary); 
							$('#currency-symbol_2').html(data.currency_2);
							$('#currency_symbol2').val(data.currency_2);    
							$('#currency_2_position').val(data.currency_2_position); 							
							$('#currency_2_status').val(data.currency_2_status);
							$('#maxdays').val(data.maxdays);
							$('#edit_general').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>

		<!-- send edit form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_edit']").submit(function(){
					$.ajax({
						url : 'admin_web_config_ed.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#e_errmsg").html(data.msg);														
							} else {
								window.location='admin_web_config.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>

    </body>	

</html>