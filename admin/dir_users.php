<?php
	
	/* dir_users.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	
	
	/* page title */
	
	if (isset($conrow['company_name']))	
		$title = $conrow['company_name'] . ' - Directorio de Usuarios';	
	else	
		$title = 'Directorio de Usuario';

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
						<li class="breadcrumb-item active" aria-current="page">Directorio de Usuarios</li>
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">
					
						<h5><strong>Directorio de Usuarios</strong></h5>			
						
						<div class="row dash-row mt-4">							
					
							<div class="col">								
					
								<div class="container-fluid border-top border-bottom pl-0 py-3 mb-4">
									<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_item">Agregar Nuevo Usuario</button>	
								</div>
												
								<?php
						
									$stmt = $db->prepare('SELECT id, first_name, last_name, email, level FROM utenti ORDER BY first_name');
									$stmt->execute();	
									
									$numitems = $stmt->rowCount();
									
									if ($numitems == 0) {
									
										echo '<div class="alert alert-danger mt-5" role="alert">';
											echo 'This table is empty!';
										echo '</div>';		
									
									} else {
										
										$output = "";
										
										while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
											
											$disp_name = $rrows['first_name'] . " " . $rrows['last_name'];
											
											if ($rrows['level'] == 2)
												$disp_level = "Administrator";
											elseif ($rrows['level'] == 1)
												$disp_level = "Webmaster";
											elseif ($rrows['level'] == 0)
												$disp_level = "Collaborator";
												
											/* retrieve last login */
											
											$access = 1;
											$stmt_lastlog = $db->prepare('SELECT data FROM log_accessi WHERE mail_immessa = :mail_immessa AND accesso = :accesso ORDER BY data DESC LIMIT 1,1');
											$stmt_lastlog->execute(array(':mail_immessa' => $rrows['email'], ':accesso' => $access));
											
											$rowlast = $stmt_lastlog->fetch();

											/* fomat last loging */

											if (isset($rowlast['data']))
												$disp_last = $rowlast['data'];
											else
												$disp_last = "No logged yet";
											
											/* links to edit and delete */
											
											$edit = '<button type="button" name="edit" value="Edit" id="' . $rrows['id'] . '" class="btn btn-info btn-sm edit_data"><i class="fas fa-pencil-alt"></i></button>';
											
											/* if user displayed is active user, do not show delete item option */
											
											if ($_SESSION['user'] == $rrows['id'])
												$del = "";
											else											
												$del = '<a data-org="users" data-row-id="' . $rrows['id'] . '" data-name="' .  $disp_name . '" href="javascript:void(0)" class="btn btn-danger btn-sm delete_item ml-3"><i class="fas fa-trash-alt"></i></a>';
										
											$output .= '<tr>';
												$output .= '<td>' . $disp_name . '</td><td style="text-align: left;"><a href="mailto:' . $rrows['email']  . '" style="color:#0056b3;">' . $rrows['email'] . '</a></td><td style="text-align: center;">' . $disp_level . '</td><td style="text-align: center;">' . $disp_last . '</td><td class="text-center">' . $edit . $del . '</td>';
											$output .= '</tr>';

										}
										
										if (isset($_GET['msgok'])) {
											echo '<div class="alert alert-success" role="alert"><strong><i class="far fa-check-circle fa-lg"></i> Item deleted succesfully!</strong></div>';
										}
										
										echo '<table id="table_list" class="table table-bordered table-hover">';
											echo '<thead class="thead-dark">';
												echo '<tr><th scope="col" class="text-center">Nombre de Usuario</th><th scope="col" class="text-center">Email</th><th scope="col" class="text-center">Nivel</th><th scope="col" class="text-center">Ultimo Login</th><th scope="col" class="text-center">Acción</th></tr>';
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
		
		<!-- Add New User modal -->
		
		<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus mr-3"></i>Add New User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_adduser" method="post">	
					
						<div class="modal-body bg-light">	
						
							<div id="errmsg"></div>

							<div class="form-row">
								<div class="col">
									<label for="level" class="col-form-label">Access Level:</label>
									<select class="custom-select mr-sm-2" id="level" name="level" required>
										<option value="0">Collaborator</option>
										<option value="1">Webmaster</option>	
										<option value="2">Administrator</option>	
									</select>
								</div>
							</div>

							<div class="form-row">								
								<div class="col">
									<label for="email" class="col-form-label">Email:</label>
									<input type="email" id="email" name="email" class="form-control" required>
								</div>
							</div>	

							<div class="form-row">								
								<div class="col-12 col-md-6">
									<label for="first_name" class="col-form-label">First Name:</label>
									<input type="text" id="first_name" name="first_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="last_name" class="col-form-label">Last Name:</label>
									<input type="text" id="last_name" name="last_name" class="form-control" required>
								</div>
							</div>								
							
							<div class="form-row">
								<div class="col-12 col-md-6">
									<label for="password" class="col-form-label">Password:</label><small><em> (at least 8 characters)</em></small>
									<input type="text" class="form-control" id="password" name="password" required>
								</div>
								<div class="col-12 col-md-6">
									<label for="password" class="col-form-label">Confirm Password:</label>
									<input type="text" class="form-control" id="confirm_password" name="confirm_password" required>
								</div>
							</div>

							<div class="modal-footer border-0">							
								<input type="submit" class="btn btn-sm btn-primary" id="register" name="register" value="Submit">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Edit User modal -->
		
		<div class="modal fade" id="edit_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user mr-3"></i>Edit User</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edituser" method="post">	
					
						<div class="modal-body bg-light">	
						
							<div id="e_errmsg"></div>

							<div class="form-row">
								<div class="col">
									<label for="elevel" class="col-form-label">Access Level:</label>
									<select class="custom-select mr-sm-2" id="elevel" name="elevel" required>
										<option value="0">Collaborator</option>
										<option value="1">Webmaster</option>	
										<option value="2">Administrator</option>	
									</select>
								</div>
							</div>

							<div class="form-row">								
								<div class="col-12 col-md-6">
									<label for="efirst_name" class="col-form-label">First Name:</label>
									<input type="text" id="efirst_name" name="efirst_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="elast_name" class="col-form-label">Last Name:</label>
									<input type="text" id="elast_name" name="elast_name" class="form-control" required>
								</div>
							</div>								

							<div class="modal-footer border-0">	
								<input type="hidden" id="eid" name="eid">
								<input type="submit" class="btn btn-sm btn-primary" id="edit" name="edit" value="Submit">
								<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>						
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
		
		<!-- check matches -->
		
		<script>
			$(document).ready(function(){ 			
				var password = document.getElementsByName("password")[0];
				var confirm_password = document.getElementsByName("confirm_password")[0];
				function validatePassword(){
					if(password.value != confirm_password.value) {
						confirm_password.setCustomValidity("Passwords Don't Match");
					} else {
						confirm_password.setCustomValidity('');
					}
				}
				password.onchange = validatePassword;
				confirm_password.onkeyup = validatePassword;				
			}); 		
		</script>
		
		<!-- send form_adduser form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_adduser']").submit(function(){
					$.ajax({
						url : 'dir_users_add.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#errmsg").html(data.msg);														
							} else {
								window.location='dir_users.php' 								
							}	
						}
					});
					return false;
				});
			});			
		</script>
		
		<!-- populate form_edituser form -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_data', function(){  
					var id = $(this).attr("id");  
					$.ajax({  
						url:"fetch_user.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){ 
							$('#eid').val(data.id); 
							$('#elevel').val(data.level); 
							$('#efirst_name').val(data.first_name);  
							$('#elast_name').val(data.last_name);  
							$('#edit_item').modal('show');  
						}  
					});  
				});  		
			});  
		 </script>
		 
		<!-- send form_edituser form -->
		
		<script>		
			$(document).ready(function(){
				$("form[id='form_edituser']").submit(function(){
					$.ajax({
						url : 'dir_users_edit.php',
						type : 'POST',
						data : $(this).serialize(),
						dataType:"json",  
						success : function(data){	
							if (data.msgstat === 1) {
								$("#e_errmsg").html(data.msg);														
							} else {
								window.location='dir_users.php' 								
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
				$('.delete_item').click(function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var roworg = $(this).attr('data-org');
					var rowname = $(this).attr('data-name');
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
					bootbox.dialog({
						message: "<div class='alert alert-danger text-center' role='alert'>Are you sure you want to eliminate this item?<strong><br>" + rowname + "<br></strong>All information related will be eliminated too!</strong></div>",
						title: "<i class='fas fa-trash-alt text-danger'></i> Delete Item!",
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
										window.location.replace("dir_users?msgok=1");
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