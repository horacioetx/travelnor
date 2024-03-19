<?php

	//include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	//define page title
	
	$title = "Directorio de Usuarios";
	
	/* save new user */
	
	/* member registration form has been submitted process with validation and save record */

	if($_POST['register'] == "register") {

		if(strlen($_POST['username']) < 5) {
			
			$msg = 'Nombre de usuario muy corto! Intenta con 5 caracteres o más.';
			header("Location: dir_users?&errmsg=$msg");
			exit();
			
		} 		
					
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row['username']){				
			$msg = 'Nombre de usuario ya existe! Intenta con otro';	
			header("Location: dir_users?&errmsg=$msg");
			exit();
		}
	
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($row['email']){
			$msg = 'Este email ya esta registrado! Intenta con otro';
			header("Location: dir_users?&errmsg=$msg");
			exit();
		}
		
		if(strlen($_POST['password']) < 5) {
			
			$msg = 'Password muy corto! Intenta con 5 caracteres o más.';
			header("Location: dir_users?&errmsg=$msg");
			exit();
			
		} 	
		
		/* Everything validate and proceed registration */
			
		/* hash the password */
		
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
		
		//insert into database with a prepared statement	

		$stmt = $db->prepare('INSERT INTO members (first_name, last_name, username, password, email, level, active) VALUES (:first_name, :last_name, :username, :password, :email, :level, :active)');
		$stmt->execute(array(
			':first_name' => $_POST['first_name'],
			':last_name' => $_POST['last_name'],
			':username' => $_POST['username'],
			':password' => $hashedpassword,
			':email' => $_POST['email'],
			':level' => $_POST['level'],
			':active' => "yes"));

		/* sends email to new user with registration information */
		
		$message = '<!DOCTYPE html>
					<html lang="es">
						<head>
							  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
							  <title>Registro en mishyjoaco.com</title>
							  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
						</head>

						<body style="margin: 0; padding: 0; font-family: Verdana, Calibri, Arial, Helvetica Neue,Segoe UI,Helvetica, Lucida Grande ,sans-serif; font-size: 15px;">
						
							<div style="width:600px; margin: 0 auto; padding: 10px 0 0 0;">
						
								<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; border: none;">
								
									<tr>
										<td align="center" style="padding: 20px 0 15px 0;">
											<img src="http://www.travelnor.com/dashboard/html/images/logos/logo.png" alt="Logo" style="width:150px; height: auto; display: block;" />
										</td>
									</tr>
									
									<tr> 
										<td align="center" style="padding: 10px 0 20px 0; text-align: center; line-height: 30px; font-size: 110%; font-weight:700;">Hola ' . $_POST['first_name'] . ' ' .  $_POST['last_name'] . '</td>
									</tr>
									
									<tr>
										<td align="left" style="text-align:center; line-height:25px;; padding: 5px 10px 20px 10px;">Has sido registrado en el sistema de Travelnor. A continuación encontrarás tus credenciales de acceso.</td>
									
									</tr>
									
									<tr>								
										<td align="center" style="text-align:center; line-height:50px; padding: 0;">	
										
											<div style="margin:1em; border-top:1px solid #ccc; border-bottom:1px solid #ccc;">
									
												<table align="center" border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin: 10px; border-collapse: collapse; border: none;">
										
													<tr>
														<td align="right" valign="top" style="text-align:right; line-height:20px; padding: 5px 0; width:50%; font-weight:700;">Nombre de Usuario : </td>
														<td align="left" style="text-align:left; line-height:20px; padding: 5px 0 5px 5px; width:50%;"> ' . $_POST['username']. '</td>
													</tr>
													<tr>
														<td align="right" valign="top" style="text-align:right; line-height:20px; padding: 5px 0; font-weight:700;">Contraseña : </td>
														<td align="left" style="text-align:left; line-height:20px; padding: 5px 0 5px 5px;"> ' . $_POST['password'] . '</td>
													</tr>	
													<tr>
														<td align="right" valign="top" style="text-align:right; line-height:20px; padding: 5px 0; font-weight:700;">URL de Acceso : </td>
														<td align="left" style="text-align:left; line-height:20px; padding: 5px 0 5px 5px;"><a href="www.travelnor.com/dashboard/html/login.php">www.travelnor.com/dashboard/html/login.php</a></td>
													</tr>	
													
												</table>
												
											</div>
											
										</td>
										
									</tr>		

									<tr>
										<td align="center" style="font-size:70%; font-weight:400; text-align: center; padding: 3px 0; backgound-color:#fff;">Travelnor.com Dashboard. All rights reserved. Powered by NDDInfosystems</td>
									</tr>
									
								</table>
								
							</div>
								
						</body>
						
					</html>';

		/* assign headers to email */
		
		$from = "admin@cucoa.com";
		$to2 = $_POST['email'];
		$subject = "Has sido registrado en travelnor.com Dashboard";
		
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=UTF-8";		
		$headers[] = "From: " . $from . "<" . $from . ">";
		$headers[] = "Reply-To: Recipient Name <" . $from . ">";
		$headers[] = "Subject: {$subject}";
		$headers[] = "X-Priority: 1";
		$headers[] = "X-Mailer: PHP/".phpversion();

		mail($to2, $subject, $message, implode("\r\n", $headers));

		header("Location: dir_users?okmsg=Usuario registrado!");
		
	}

	
	
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	
		
		<!-- Bootstrap CSS -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/379421e620.js" crossorigin="anonymous"></script>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i|Playfair+Display&display=swap" rel="stylesheet">		

		<!-- custom CSS -->

		<link href="css/styles.css" rel="stylesheet">

		<title><?php echo $title; ?></title>
		
	</head>
	
	<body>
	
		<!-- top navbar -->
		
		<?php include ("navbar.php"); ?>	
		
		<!-- sidebar and main content -->
		
		<div class="row" id="body-row">			
			
			<?php include ("navbar_side.php"); ?>			

			<div class="col">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item active" aria-current="page">Directorio de Usuarios</li>
						</ol>
					</nav>							
				</div>
	
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newuser">Agregar Usuario</button>

				<?php
				
					$stmt = $db->prepare('SELECT memberID, first_name, last_name, username, email, level FROM members ORDER BY first_name');
					$stmt->execute();	
					
					$numitems = $stmt->rowCount();
					
					if ($numitems == 0) {
					
						echo '<div class="alert alert-danger mt-5" role="alert">';
							echo 'Esta tabla está vacia!';
						echo '</div>';		
					
					} else {
						
						$output = "";
						$cont1 = 0;
						
						while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	
						
							$cont1++;
							
							$disp_name = $rrows['first_name'] . " " . $rrows['last_name'];
							
							if ($rrows['level'] == 2)
								$disp_level = "Administrador";
							elseif ($rrows['level'] == 1)
								$disp_level = "Webmaster";
							elseif ($rrows['level'] == 0)
								$disp_level = "Colaborador";
							
							/* links to edit and delete */
							
							$edit = '<td style="text-align: center;"><input type="button" name="edit" value="Editar" id="' . $rrows['memberID'] . '" class="btn btn-info btn-sm edit_data" /></td>';
							
					//		$edit = '<td style="text-align: center;"><input type="button" name="edit" value="Editar" subid="' . $rrows_x['subcontact_id'] . '" class="btn btn-info btn-sm edit_data_sub float-right" disabled>';
							
							
							$output .= '<tr>';
								$output .= '<td>' . $disp_name . '</td><td>' . $rrows['username'] . '</td><td style="text-align: left;"><a href="mailto:' . $rrows['email']  . '" style="color:#0056b3;">' . $rrows['email'] . '</a></td><td style="text-align: center;">' . $disp_level . '</td>' . $edit;
							$output .= '</tr>';

						}
						
						echo '<p class="text-right">Número de Usuarios : ' . $cont1 . '</p>';
						
						echo '<table id="table_list" class="table table-bordered table-hover">';
							echo '<thead class="thead-dark">';
								echo '<tr><th scope="col">Usuario</th><th scope="col" style="text-align: center;">Nombre de Usuario</th><th scope="col" style="text-align: center;">Email</th><th scope="col" style="text-align: center;">Nivel</th><th scope="col" style="text-align: center;">Ver</th></tr>';
							echo '</thead>';
							echo '<tbody>';						
								echo $output;							
							echo '</tbody>';						
						echo '</table>';
							
					}
				
				?>

			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>			
		
		<!-- MODALS -->
		
		<!-- Add new contact modal -->
		
		<div class="modal fade" id="newuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog modal-lg" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_adduser" method="post">	
					
						<div class="modal-body">	
						
							<div class="form-row">
								<div class="col">
									<label for="level" class="col-form-label">Nivel de Acceso:</label>
									<select class="custom-select mr-sm-2" id="level" name="level" required>
										<option value="0">Colaborador</option>
										<option value="1">Webmaster</option>	
										<option value="2">Administrador</option>	
									</select>
								</div>
							</div>

							<div class="form-row">								
								<div class="col">
									<label for="first_name" class="col-form-label">Nombre:</label>
									<input type="text" id="first_name" name="first_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="last_name" class="col-form-label">Apellido:</label>
									<input type="text" id="last_name" name="last_name" class="form-control" required>
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="username" class="col-form-label">Nombre de Usuario:</label>
									<input type="text" id="username" name="username" class="form-control" required>
								</div>
							</div>	

							<div class="form-row">
								<div class="col">
									<label for="password" class="col-form-label">Password:</label><small> Más de 6 caracteres</small>
									<input type="text" class="form-control" id="password" name="password" required>
								</div>
							</div>
							
							<div class="form-row">								
								<div class="col">
									<label for="email" class="col-form-label">Email:</label>
									<input type="email" id="email" name="email" class="form-control" required>
								</div>
							</div>	

							<div class="modal-footer">							
								<button type="submit" class="btn btn-primary" id="register" name="register" value="register">Enviar Registro</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Edit contact modal -->
		
		<div class="modal fade" id="edituser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog modal-lg" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_edituser" method="post">	
					
						<div class="modal-body">	
						
							<div class="form-row">
								<div class="col">
									<label for="elevel" class="col-form-label">Nivel de Acceso:</label>
									<select class="custom-select mr-sm-2" id="elevel" name="elevel" required>
										<option value="0">Colaborador</option>
										<option value="1">Webmaster</option>	
										<option value="2">Administrador</option>	
									</select>
								</div>
							</div>

							<div class="form-row">								
								<div class="col">
									<label for="efirst_name" class="col-form-label">Nombre:</label>
									<input type="text" id="efirst_name" name="efirst_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="elast_name" class="col-form-label">Apellido:</label>
									<input type="text" id="elast_name" name="elast_name" class="form-control" required>
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="eusername" class="col-form-label">Nombre de Usuario:</label>
									<input type="text" id="eusername" name="eusername" class="form-control" required>
								</div>
							</div>	

							<div class="form-row">
								<div class="col">
									<label for="epassword" class="col-form-label">Password:</label><small> Más de 6 caracteres</small>
									<input type="text" class="form-control" id="epassword" name="epassword" required>
								</div>
							</div>
							
							<div class="form-row">								
								<div class="col">
									<label for="eemail" class="col-form-label">Email:</label>
									<input type="email" id="eemail" name="eemail" class="form-control" required>
								</div>
							</div>	

							<div class="modal-footer">
								<input type="hidden" id="ememberID" name="ememberID" value="">
								<button type="submit" class="btn btn-primary" id="edit" name="edit" value="register">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<!-- datatables -->		
		
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>		

		<!-- Optional JavaScript -->
		
		<!-- Menu Toggle Script -->
		
		<script>
			$('#body-row .collapse').collapse('hide');
			$('#collapse-icon').addClass('fa-angle-double-left');
			$('[data-toggle=sidebar-colapse]').click(function() {
				SidebarCollapse();
			});
			function SidebarCollapse () {
				$('.menu-collapsed').toggleClass('d-none');
				$('.sidebar-submenu').toggleClass('d-none');
				$('.submenu-icon').toggleClass('d-none');
				$('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
				var SeparatorTitle = $('.sidebar-separator-title');
				if ( SeparatorTitle.hasClass('d-flex') ) {
					SeparatorTitle.removeClass('d-flex');
				} else {
					SeparatorTitle.addClass('d-flex');
				}				
				$('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
			}					
		</script>

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

		<!-- edit user -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_data', function(){  
					var memberid = $(this).attr("id");  
					$.ajax({  
						url:"fetch_user.php",  
						method:"POST",  
						data:{memberID:memberid},  
						dataType:"json",  
						success:function(data){  
							$('#elevel').val(data.level);  
							$('#efirst_name').val(data.first_name);  
							$('#elast_name').val(data.last_name);  
							$('#eusername').val(data.username);  
							$('#eemail').val(data.email);  
							$('#ememberID').val(data.memberID);  							
							$('#edituser').modal('show');  
						}  
					});  
				});  		
			});  
		 </script>

	</body>
	
</html>