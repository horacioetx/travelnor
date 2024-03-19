<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	/* receive vars */	

    $confid = 1;

	if ($_POST['legal_id'] == 'lgtxt1') {

		$stmt = $db->prepare("UPDATE config SET 
								web1_legal1_title = :lgl_title,
                                web1_legal1 = :lgl_txt
								WHERE config_id = :config_id");
							
	} elseif ($_POST['legal_id'] == 'lgtxt2') {
		
		$stmt = $db->prepare("UPDATE config SET 
								web1_legal2_title = :lgl_title,
                                web1_legal2 = :lgl_txt
								WHERE config_id = :config_id");		
		
	} elseif ($_POST['legal_id'] == 'lgtxt3') {
		
		$stmt = $db->prepare("UPDATE config SET 
								web1_legal3_title = :lgl_title,
                                web1_legal3 = :lgl_txt
								WHERE config_id = :config_id");		
		
	} elseif ($_POST['legal_id'] == 'lgtxt4') {
		
		$stmt = $db->prepare("UPDATE config SET 
								web1_legal4_title = :lgl_title,
                                web1_legal4 = :lgl_txt
								WHERE config_id = :config_id");		
		
	} elseif ($_POST['legal_id'] == 'lgtxt5') {
		
		$stmt = $db->prepare("UPDATE config SET 
								web1_legal5_title = :lgl_title,
                                web1_legal5 = :lgl_txt
								WHERE config_id = :config_id");		
		
	}
							
	$stmt->execute(array(':lgl_txt' => $_POST['legal_txt'],
						 ':lgl_title' => $_POST['legal_title'],
                         ':config_id' => $confid));
	
	/* proceed to build display */	
	
    if ($_POST['legal_id'] == 'lgtxt1') {

        $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt1" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>';
		echo '<h5 class="mt-2 mb-4"><strong>' . $_POST['legal_title']  . '</strong>' . $edit . '</h5>';
        echo '<div class="alert alert-warning" role="alert">' . $_POST['legal_txt'] . '</div>';  

    } elseif ($_POST['legal_id'] == 'lgtxt2') {

        $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt2" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>';
		echo '<h5 class="mt-2 mb-4"><strong>' . $_POST['legal_title'] . '</strong>' . $edit . '</h5> ';
        echo '<div class="alert alert-warning " role="alert">' . $_POST['legal_txt'] . '</div>';  

    } elseif ($_POST['legal_id'] == 'lgtxt3') {

        $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt3" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>';
		echo '<h5 class="mt-2 mb-4"><strong>' . $_POST['legal_title'] . '</strong>' . $edit . '</h5> ';
        echo '<div class="alert alert-warning " role="alert">' . $_POST['legal_txt'] . '</div>';  

    } elseif ($_POST['legal_id'] == 'lgtxt4') {

        $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt4" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>';
		echo '<h5 class="mt-2 mb-4"><strong>' . $_POST['legal_title'] . '</strong>' . $edit . '</h5> ';
        echo '<div class="alert alert-warning " role="alert">' . $_POST['legal_txt'] . '</div>';  

    } elseif ($_POST['legal_id'] == 'lgtxt5') {

        $edit = '<button type="button" name="edit" value="Editar" subid="lgtxt5" class="btn btn-info btn-sm edit_data float-right"><i class="fas fa-pencil-alt"></i></button>';
		echo '<h5 class="mt-2 mb-4"><strong>' . $_POST['legal_title'] . '</strong>' . $edit . '</h5> ';
        echo '<div class="alert alert-warning " role="alert">' . $_POST['legal_txt'] . '</div>';  

    }

?>

