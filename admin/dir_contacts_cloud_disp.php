<?php

	/*** Dipslay docs on selected folder ***/
	/*** This routine is called from fetch_foldor.php $ upload_files.php ***/

	/* refresh div */
	
	if ($_POST['folid'])
		$rowid = $_POST['folid'];
	elseif ($_POST['folder_id'])
		$rowid = $_POST['folder_id'];
	
	/* retrieve name of folder */
	
	$stmt_fol = $db->prepare('SELECT fold_name FROM dir_contacts_folders WHERE fold_id = :fold_id');	
	$stmt_fol->execute(array(':fold_id' => $rowid));
	$rowfol = $stmt_fol->fetch(PDO::FETCH_ASSOC);
	
	$disp_folname = $rowfol['fold_name'];

	/* retrieve files from folder selected */
	
	$stmt = $db->prepare('SELECT * FROM dir_contacts_folders_docs WHERE doc_folder = :doc_folder');	
	$stmt->execute(array(':doc_folder' => $rowid));
	
	$numitems = $stmt->rowCount();
	
	echo '<h5 class="card-title"><i class="fas fa-folder-open"></i> ' . $disp_folname . '</h5>';
		
	if ($numitems == 0) {		
	
		echo '<div class="alert alert-danger mt-2" role="alert">';
			echo 'No hay documentos en esta carpeta aún!';
		echo '</div>';		
	
	} else {
	
		while ($rowfile = $stmt->fetch(PDO::FETCH_ASSOC)) {			
			
			echo '<div id="' . $rowfile['doc_id'] . '">';

				$deldoc = '<a data-org="delfile" data-row-id="' . $rowfile['doc_id'] . '" href="javascript:void(0)" class="delete_file ml-0" title="Eliminar Documento"><span aria-hidden="true" class="text-danger">&times;</span></a>';
			
				echo '<div class="col text-left">';
					echo '<a href="contacts_files/'. $rowfile['doc_name'] . '" target="_blank" class="text-dark"><i class="far fa-file-alt"></i><span class="text-left text-dark"> ' . $rowfile['doc_name'] . '</span></a><div class="float-right">' . $deldoc . '</div>';
				echo '</div>';
				
			echo '</div>';
		
		}
		
	}
	
	echo '<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" class="mt-4">';
		echo '<div id="drag_upload_file">';
			echo '<p>Drop file here</p>';
			echo '<p>or</p>';
			echo '<p><input type="button" value="Select File" onclick="file_explorer();"></p>';
			echo '<input type="file" id="selectfile">';
			echo '<input type="hidden" id="idfolder" name="idfolder" fold-row-id="' . $rowid . '">';
		echo '</div>';
	echo '</div>';
	
?>

<!-- delete file function -->

<script>
	$(document).ready(function(){
		$('.delete_file').click(function(e){
			e.preventDefault();
			var rowid = $(this).attr('data-row-id');
			var roworg = $(this).attr('data-org');
			var dataString = 'rowid=' + rowid + '&roworg=' + roworg;					
			var parent = $("#"+rowid);					
			bootbox.dialog({
				message: "<div class='alert alert-danger' role='alert'>Estas seguro que quieres eliminar este documento?</div>",
				title: "<i class='fas fa-trash-alt'></i> Eliminar Documento!",
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
								bootbox.alert('Error. No se pudo eliminar documento!');
							})
						}
					}
				}
			});
		});
	});
</script>