<?php

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

    if (isset($_POST['target_id'])) {
	
        /* upload path */    
        
        if ($_POST['target_id'] == "ticker") { 	
            $path = '../images/ticker/';        
        } elseif ($_POST['target_id'] == "ribbon") { 	
            $path = '../images/ribbons/';	
        } elseif ($_POST['target_id'] == "thumb") { 	
            $path = '../images/ourtrips/';	
        } elseif ($_POST['target_id'] == "map") { 
            $path = '../images/maps/';	
        } elseif ($_POST['target_id'] == "ext") { 
            $path = '../images/extensions/';	
        } else {		
            $path = '../images/programs_slides/';		
        }

        /* upload routine */

        $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
        
        if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
            echo "false";
            return;
        }
        
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777);
        }
        
        move_uploaded_file($_FILES['file']['tmp_name'], $path . $_FILES['file']['name']);

        /* update image to table in selected program (check what image field is empty to proceed to update that field) */
        
        if (isset($_POST['program_id']))
            $prog_id = $_POST['program_id'];

        /* check where upload is coming from */	

        if ($_POST['target_id'] == "ticker") {

            $prog_id = 1;
            
            $stmt = $db->prepare('UPDATE config SET ticker_img = :ticker_img WHERE config_id = :config_id');
            
            $stmt->bindParam(':ticker_img', $_FILES['file']['name']);
            $stmt->bindParam(':config_id', $prog_id);
            
            $stmt->execute();	

            /* reload page */
            
            include "admin_web_ticker.php";
        
        }elseif ($_POST['target_id'] == "ribbon") {
            
            $stmt = $db->prepare('INSERT dir_ribbons (ribbon_file) VALUES (:ribbon_file)');
            
            $stmt->bindParam(':ribbon_file', $_FILES['file']['name']);
            
            $stmt->execute();	

            /* reload page */
            
            include "admin_program_ribbons_disp.php";
        
        } elseif ($_POST['target_id'] == "thumb") { 
            
            $stmt = $db->prepare('UPDATE dir_programs SET program_thumb_image = :program_thumb_image WHERE program_id = :program_id');
            
            $stmt->bindParam(':program_thumb_image', $_FILES['file']['name']);
            $stmt->bindParam(':program_id', $prog_id);
            
            $stmt->execute();	
            
            /* retrieve info from table */
            
            $stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
            $stmt->execute(array(':program_id' => $prog_id));
            
            $rrows = $stmt->fetch(PDO::FETCH_ASSOC);
            
            /* refresh div */
            
            include "admin_program_view_disp_thumb.php";
            
        } elseif ($_POST['target_id'] == "map") { 
            
            $stmt = $db->prepare('UPDATE dir_programs SET program_map1 = :program_map1 WHERE program_id = :program_id');
            
            $stmt->bindParam(':program_map1', $_FILES['file']['name']);
            $stmt->bindParam(':program_id', $prog_id);
            
            $stmt->execute();	
            
            /* retrieve info from table */
            
            $stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
            $stmt->execute(array(':program_id' => $prog_id));
            
            $rrows = $stmt->fetch(PDO::FETCH_ASSOC);
            
            /* refresh div */
            
            include "admin_program_view_disp_map.php";		
            
        } elseif ($_POST['target_id'] == "ext") { 
            
            $stmt = $db->prepare('UPDATE dir_programs_extensions SET ext_image = :ext_image WHERE ext_program = :ext_program');
            
            $stmt->bindParam(':ext_image', $_FILES['file']['name']);
            $stmt->bindParam(':ext_program', $prog_id);
            
            $stmt->execute();	
            
            /* refresh div */
            
            include "admin_program_extensions_disp.php";	

        } else { 
            
            /* retrieve info from table */
            
            $stmt = $db->prepare('SELECT program_banner1, program_banner2, program_banner3, program_banner4 FROM dir_programs WHERE program_id = :program_id');	
            $stmt->execute(array(':program_id' => $prog_id));	
            $rrows = $stmt->fetch(PDO::FETCH_ASSOC);	
            
            if ($rrows['program_banner1'] == '')
                $stmt = $db->prepare('UPDATE dir_programs SET program_banner1 = :program_banner WHERE program_id = :program_id');
            elseif ($rrows['program_banner2'] == '')
                $stmt = $db->prepare('UPDATE dir_programs SET program_banner2 = :program_banner WHERE program_id = :program_id');
            elseif ($rrows['program_banner3'] == '')
                $stmt = $db->prepare('UPDATE dir_programs SET program_banner3 = :program_banner WHERE program_id = :program_id');
            elseif ($rrows['program_banner4'] == '')
                $stmt = $db->prepare('UPDATE dir_programs SET program_banner4 = :program_banner WHERE program_id = :program_id');
                
            $stmt->bindParam(':program_banner', $_FILES['file']['name']);
            $stmt->bindParam(':program_id', $prog_id);

            $stmt->execute();	

            /* retrieve info from table */
            
            $stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
            $stmt->execute(array(':program_id' => $prog_id));
            
            $rrows = $stmt->fetch(PDO::FETCH_ASSOC);

            /* refresh div */
            
            include "admin_program_view_disp_imgcar.php";
            
        }

    }
	
?>


