<?php

	/* Cloud documents folder structure for contacts  */
	
?>

<h5 class="mb-3"><strong>Documentos</strong></h5>

<div class="card easion-card h-100">

	<div class="card-header d-flex justify-content-between align-items-center">
		<div class="text-warning font-weight-bold"><?php echo $rrows['contact_name'] . " "  . $rrows['contact_lastname']; ?></div>
		<div><button type="button" data-toggle="modal" data-target="#create_folder" class="btn btn-info btn-sm float-right"><i class="fas fa-folder-plus"></i></button></div>
	</div>

	<div class="card-body">	
		<div class="row">
			
			<?php

				$stmt_fol = $db->prepare('SELECT * FROM dir_contacts_folders WHERE fold_contact = :fold_contact');	
				$stmt_fol->execute(array(':fold_contact' => $contact_id));

				$numitems = $stmt_fol->rowCount();
				
				if ($numitems == 0) {
						
						echo '<div class="col">';						
							echo '<p class="card-text"><strong>No existen carpetas para este contacto</strong></p>';
						echo '</div>';
					
				} else {
				
					while ($frows = $stmt_fol->fetch(PDO::FETCH_ASSOC)) {	

						echo '<div id="' . $frows['fold_id'] . '">';

							$delfol = '<a data-org="delfolder" data-row-id="' . $frows['fold_id'] . '" href="javascript:void(0)" class="delete_folder ml-0" title="Eliminar Carpeta"><span aria-hidden="true" class="text-danger"><i class="fas fa-minus-circle"></i></span></a>';
						
							echo '<div class="col text-center">';
									echo '<div class="text-left">' . $delfol . '</div>';
									echo '<a foldid="' . $frows['fold_id'] . '" href="javascript:void(0)" class="show_files"> <img src="images/folder_icon.png" class="img-fluid" style="width: 100% \9;" title="Abrir carpeta" /><br /><div class="text-center text-dark"><strong>' . $frows['fold_name'] . '</strong></div> </a>';
							echo '</div>';
							
						echo '</div>';

					} 
				
				}		
			
			?>

		</div>
	</div>
</div>

<!-- modal to open folder -->

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

<!-- Modal to display folder content -->

<div class="modal fade" id="open_folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
	<div class="modal-dialog" role="document">			
		<div class="modal-content">				
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-folder"></i> Carpetas de <?php echo $rrows['contact_name'] . " "  . $rrows['contact_lastname']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>					
			<div class="modal-body">			
				<div id="folder_content"></div>
			</div>	
		</div>				
	</div>			
</div>

<!-- open folder -->
		
<script>		
	$(document).ready(function(){
		$('.show_files').click(function(){
			var folder_id = $(this).attr('foldid');
			$.ajax({  
				url:"fetch_folder.php",  
				method:"POST",  
				data:{folder_id:folder_id},  
				success:function(data){  
					$("#folder_content").html(data);
					$("#idfolder").attr("fold-row-id",folder_id);
					$('#open_folder').modal('show');  
				}  
			});  
		});  	 
	});  
</script>

<!-- delete folder function -->

<script>
	$(document).ready(function(){
		$('.delete_folder').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			var parent = $("#"+rowid);					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar esta carpeta?<br />Todos los archivos guardados en esta carpeta se elimnarán también.</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Carpeta!",
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
								bootbox.alert(response);
								parent.fadeOut('slow');
							})
							.fail(function(){
								bootbox.alert('Error. No se pudo eliminar carpeta');
							})
						}
					}
				}
			});
		});
	});
</script>

<!-- upload files -->

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
			var folder_id = $("#idfolder").attr('fold-row-id');
			var form_data = new FormData();                  
			form_data.append('file', file_obj);
			form_data.append('folid', folder_id);
			$.ajax({
				type: 'POST',
				url: 'upload_files.php',
				contentType: false,
				processData: false,
				data: form_data,
				success:function(response) {
					$("#folder_content").html(response);		
				}
			});
		}
	}
</script>
