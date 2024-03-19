<?php

    /* admin_program_extensions.php */
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }	

    /* receive vars */
	
	$prog_id = $_REQUEST['progid'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT program_name FROM dir_programs WHERE program_id = :program_id');	
	$stmt->execute(array(':program_id' => $prog_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

    /* page title */
	
	if (isset($conrow['company_name']))	
        $title = $conrow['company_name'] . ' - ' . str_replace("<br />", " ", $rrows['program_name']);
    else	
        $title = str_replace("<br />", " ", $rrows['program_name']);

    $active_page = 6;

?>

<!DOCTYPE html>
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

		<!-- js -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		
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
						<li class="breadcrumb-item"><a href="admin_programs">Directorio de Viajes</a></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo str_replace('<br />', ' ', $rrows['program_name']); ?></li>						
					</ol>
				</nav>					

				<!-- main content -->				
				
				<main class="dash-content">
				
					<div class="container-fluid">

                        <div class="row">						
                            <div class="col">
                                <?php include("program_subnav.php"); ?>                                
                            </div>
                        </div>

                        <div class="row">						
                            <div class="col">

                                <div class="jumbotron jumbotron-fluid mt-4 py-2 border-top border-bottom bg-transparent">
                                    <div class="container ml-0 pl-0">
                                        <h2 class="text-dark">Programa : <span class="text-success"><?php echo str_replace("<br />", " ", $rrows['program_name']); ?></span></h2>
                                    </div>
                                </div>
                                
                                <!-- display extension info -->
				
                                <div id="disp_extension">
                                    
                                    <?php include 'admin_program_extensions_disp.php'; ?>	
                                
                                </div>	

                            </div>
                        </div>

                    </div>		

				</main>
				
			</div>
			
		</div>		

		<!-- MODALS -->

        <!-- Add new extension -->
		
		<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
            <div class="modal-dialog" role="document">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Agregar Extensión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form id="form_add" method="post" action="admin">	
                    
                        <div class="modal-body">	

                            <div class="form-row">								
                                <div class="col">
                                    <label for="ext_name" class="col-form-label">Nombre de Extensión :</label>
                                    <input type="text" id="ext_name" name="ext_name" class="form-control" value="">
                                </div>
                            </div>		

                            <div class="form-row">								
                                <div class="col">
                                    <label for="ext_nites" class="col-form-label">No. de Noches : </label>
                                    <select class="custom-select mr-sm-2" id="ext_nites" name="ext_nites" required>
                                        <?php
                                            for ($i=1; $i<=$conrow['maxdays']; $i++) {
                                                echo '<option>' . $i . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>	

                            <div class="form-row">
                                <div class="col">
                                    <label for="ext_status" class="col-form-label">Status :</label>
                                    <select class="custom-select mr-sm-2" id="ext_status" name="ext_status">
                                        <option value="0" class="text-success">Activo</option>
                                        <option value="1" class="text-danger">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                            
                                <input type="hidden" id="ext_prog_id" name="ext_prog_id" value="<?php echo $prog_id; ?>">
                                <button type="submit" class="btn btn-primary btn-sm" id="add" name="add" value="add">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        
                            </div>		

                        </div>	
                            
                    </form>						

                </div>
                
            </div>
            
        </div>
        
        <!-- modal to edit extension general Info -->
        
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
            <div class="modal-dialog" role="document">			
                <div class="modal-content">				
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pencil-alt mr-3"></i>Editar Información General de Extensión</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>					
                    <form id="form_edit" method="post" autocomplete="off">						
                        <div class="modal-body">
                        
                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_ext_name" class="col-form-label">Nombre de Extensión :</label>
                                    <input type="text" id="e_ext_name" name="e_ext_name" class="form-control" value="">
                                </div>
                            </div>		

                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_ext_nites" class="col-form-label">No. de Noches : </label>
                                    <select class="custom-select mr-sm-2" id="e_ext_nites" name="e_ext_nites" required>
                                        <?php
                                            for ($i=1; $i<=$conrow['maxdays']; $i++) {
                                                echo '<option>' . $i . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>	
                            
                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_ext_hotel" class="col-form-label">Hotel :</label>
                                    <input type="text" id="e_ext_hotel" name="e_ext_hotel" class="form-control" value="">
                                </div>
                            </div>	
                            
                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_ext_cost" class="col-form-label">Precio :</label>
                                    <input type="text" id="e_ext_cost" name="e_ext_cost" class="form-control" value="">
                                </div>
                            </div>	
                            
                            <div class="form-row">								
                                <div class="col">
                                    <label for="e_ext_notes" class="col-form-label">Notas :</label>
                                    <textarea class="form-control" id="e_ext_notes" name="e_ext_notes" rows="5"></textarea>
                                </div>
                            </div>	

                            <div class="form-row">
                                <div class="col">
                                    <label for="e_ext_status" class="col-form-label">Status :</label>
                                    <select class="custom-select mr-sm-2" id="e_ext_status" name="e_ext_status">
                                        <option value="0" class="text-success">Activo</option>
                                        <option value="1" class="text-danger">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="modal-footer">							
                                <input type="hidden" id="e_ext_id" name="e_ext_id" value="">
                                <input type="hidden" id="e_prog_id" name="e_prog_id" value="<?php echo $prog_id; ?>">
                                <button type="submit" class="btn btn-primary btn-sm" id="editar0" name="editar0" value="edit">Guardar</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>						
                            </div>
                        </div>								
                    </form>	
                </div>				
            </div>			
        </div>

        <!-- modal to upload images for carrusel & thumb -->		
        
        <style>
            #drop_file_zone {
                background-color: #EEE; 
                border: #999 5px dashed;
                width: 100%; 
                height: auto;
                padding: 8px;
                font-size: 16px;
            }
            #drag_upload_file {
            width:50%;
            margin:0 auto;
            }
            #drag_upload_file p {
            text-align: center;
            }
            #drag_upload_file #selectfile {
            display: none;
            }
        </style>
        
        <div class="modal fade" id="imgupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
            <div class="modal-dialog" role="document">			
                <div class="modal-content">				
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-upload mr-3"></i>Subir Imágenes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>					
                    <div class="modal-body">	
                        <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" class="mt-4">
                            <div id="drag_upload_file">
                                <p>Drop file here</p>
                                <p>or</p>
                                <p><input type="button" value="Select File" onclick="file_explorer()"></p>
                                <input type="file" id="selectfile">
                                <input type="hidden" id="target_id" name="target_id" value="">
                            </div>
                        </div>
                    </div>
                        
                    </div>	
                </div>				
            </div>			
        </div>

        <!-- js -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
		<!-- custom js -->
		
		<script src="js/easion.js"></script>

        <!-- Send add form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_add']").submit(function(){
				$.ajax({
					url : 'admin_program_extensions_add.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#disp_extension").html(data);
						$('#new').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

		<!-- Edit extension gral info -->
		
		<script>		
			$(document).ready(function(){  
				$(document).on('click', '.edit_ext', function(){  
					var id = $(this).attr("id");  		
					$.ajax({  
						url:"fetch_ext.php",  
						method:"POST",  
						data:{id:id},  
						dataType:"json",  
						success:function(data){  
							$('#e_ext_name').val(data.ext_name);
							$('#e_ext_nites').val(data.ext_nites); 
							$('#e_ext_cost').val(data.ext_cost);
							$('#e_ext_notes').val(data.ext_notes);
							$('#e_ext_hotel').val(data.ext_hotel); 							
							$('#e_ext_status').val(data.ext_status);
							$('#e_ext_id').val(data.ext_id);							
							$('#edit').modal('show');  
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
					url : 'admin_program_extensions_edit.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#disp_extension").html(data);
						$('#edit').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

        <!-- upload images -->

		<script type="text/javascript">
			var fileobj;
			function upload_file(e) {
				e.preventDefault();
				fileobj = e.dataTransfer.files[0];
				ajax_file_upload(fileobj);
			}
			function file_explorer() {
				document.getElementById('selectfile').click();
				document.getElementById('selectfile').onchange = function() {
					fileobj = document.getElementById('selectfile').files[0];
					ajax_file_upload(fileobj);
				};
			}
			function ajax_file_upload(file_obj) {
				if(file_obj != undefined) {
					var target_id = "ext";
					var program_id = <?php echo $prog_id; ?>;
					var form_data = new FormData();                  
					form_data.append('file', file_obj);
					form_data.append('program_id', program_id);
					form_data.append('target_id', target_id);
					$.ajax({
						type: 'POST',
						url: 'upload_web_images.php',
						contentType: false,
						processData: false,
						data: form_data,
						success:function(response) {	
							$("#disp_extension").html(response);														
							$('#imgupload').modal('hide'); 
						}
					});
				}
			}
		</script>

		<!-- delete image function -->

		<script type="application/javascript">
			$(document).ready(function($){
				$(document).on('click', '.delete_image', function(e){
					e.preventDefault();
					var rowid = $(this).attr('data-row-id');
					var rowprg = <?php echo $prog_id; ?>;
					var roworg = $(this).attr('data-org');
					var dataString = 'rowid=' + rowid + '&roworg=' + roworg + '&rowprg=' + rowprg;					
					var parent = $("#"+rowid);					
					bootbox.dialog({
						message: "<div class='alert alert-danger text-center' role='alert'><strong>Estas seguro que quieres eliminar esta imagen?</strong></div>",
						title: "<i class='fas fa-trash-alt text-danger'></i> Eliminar Imagen!",
						buttons: {
							success: {
								label: "No",
								className: "btn-success btn-sm",
								callback: function() {
									$('.bootbox').modal('hide');
								}
							},
							danger: {
								label: "Eliminar",
								className: "btn-danger btn-sm",
								callback: function() {
									$.ajax({
										type: 'POST',
										url: 'delete_records.php',
										data: dataString,
									})
									.done(function(response){			
										$("#disp_extension").html(response);										
										bootbox.alert('<div class="alert alert-success" role="alert">Imagen eliminada satisfactoriamente!</div>');										
									})
									.fail(function(){
										bootbox.alert('Error. No se pudo eliminar imagen');
									})
								}
							}
						}
					});
				});
			});
		</script>

        <!-- delete full extension -->

        <script>
            $(document).ready(function(){
                $('.delete_extension').click(function(e){
                    e.preventDefault();
                    var rowid = $(this).attr('data-row-id');
                    var roworg = $(this).attr('data-org');
                    var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
                    bootbox.dialog({
                        message: "<div class='alert alert-danger text-center' role='alert'><strong>Estás seguro que quieres eliminar esta extensión?<br />Toda la información asociada a esta extensión también se eliminará.</strong></div>",
                        title: "<i class='fas fa-trash-alt text-danger'></i> Eliminar Extensión!",
                        buttons: {
                            success: {
                                label: "No",
                                className: "btn-success btn-sm",
                                callback: function() {
                                    $('.bootbox').modal('hide');
                                }
                            },
                            danger: {
                                label: "Eliminar",
                                className: "btn-danger btn-sm",
                                callback: function() {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'delete_records.php',
                                        data: dataString,
                                    })
                                    .done(function(response){
                                        $("#disp_extension").html(response);										
                                        bootbox.alert('<div class="alert alert-success" role="alert">Extensión eliminada satisfactoriamente!</div>');	
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



    </body>
	
</html>