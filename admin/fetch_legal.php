<?php  

	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }

	/* fetch data */	

    if (isset($_REQUEST['subid'])) {

        $rowback = array();
 
        $subid = $_REQUEST['subid'];

        if ($subid == 'lgtxt1') {
        
            $stmt = $db->prepare('SELECT web1_legal1, web1_legal1_title FROM config LIMIT 1');
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $lgl_title = $row['web1_legal1_title'];
            $lgl_txt = $row['web1_legal1'];

        } elseif ($subid == 'lgtxt2') {

            $stmt = $db->prepare('SELECT web1_legal2, web1_legal2_title FROM config LIMIT 1');
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $lgl_title = $row['web1_legal2_title'];
            $lgl_txt = $row['web1_legal2'];

        } elseif ($subid == 'lgtxt3') {

            $stmt = $db->prepare('SELECT web1_legal3, web1_legal3_title FROM config LIMIT 1');
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $lgl_title = $row['web1_legal3_title'];
            $lgl_txt = $row['web1_legal3'];

        } elseif ($subid == 'lgtxt4') {

            $stmt = $db->prepare('SELECT web1_legal4, web1_legal4_title FROM config LIMIT 1');
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $lgl_title = $row['web1_legal4_title'];
            $lgl_txt = $row['web1_legal4'];

        } elseif ($subid == 'lgtxt5') {

            $stmt = $db->prepare('SELECT web1_legal5, web1_legal5_title FROM config LIMIT 1');
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $lgl_title = $row['web1_legal5_title'];
            $lgl_txt = $row['web1_legal5'];

        }

        $rowback['lgl_title'] = $lgl_title;
        $rowback['lgl_txt'] = $lgl_txt;

        echo json_encode($rowback);  

    }
 
 ?>