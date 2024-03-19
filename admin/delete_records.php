<?php

	/*** delete records ***/
	
	/* db connection and session setup */
	
	include("check.php"); 
	
	/* if not logged in redirects to login page */
	
	if (!($_SESSION['user'])) { header('Location: login'); }
	
	switch($_POST['roworg']) {	

		case "tasks-del" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM todo WHERE task_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();				
				
				include 'todolist.php';	

			}

			break;

		case "gentxt_rate" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_gt WHERE gt_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();				
				
				include 'admin_generic_txt_rates.php';	

			}

			break;

			case "gentxt_hotel" :

				if($_POST['rowid']) {
					
					$rowid = $_POST['rowid'];
	
					$stmt = $db->prepare( "DELETE FROM dir_programs_gt WHERE gt_id = :id" );
					$stmt->bindParam(':id', $rowid);
					$stmt->execute();				
					
					include 'admin_generic_txt_hotels.php';	
	
				}
	
				break;

			case "gentxt_extension" :

				if($_POST['rowid']) {
					
					$rowid = $_POST['rowid'];
	
					$stmt = $db->prepare( "DELETE FROM dir_programs_gt WHERE gt_id = :id" );
					$stmt->bindParam(':id', $rowid);
					$stmt->execute();				
					
					include 'admin_generic_txt_extensions.php';	
	
				}
	
				break;

		case "hotcat" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_hotels_categories WHERE cat_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();				
				
				echo '<div class="alert alert-success" role="alert">Item eliminado satisfactoriamente!</div>';	

			}

			break;

		case "subcontact" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];
				$main = $_POST['rowmain'];
				$type = $_POST['rowtype'];

				$stmt = $db->prepare( "DELETE FROM dir_subcontacts WHERE subcontact_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$_REQUEST['contact_id'] = $main;
				$ctc_type = $type;

				include ("dir_contacts_specific_disp.php");

			}

			break;
			
		case "contact" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_contacts WHERE contact_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete subcontacts if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_subcontacts WHERE subcontact_contact = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();


				/* deletes folders and documents */

				/*** FALTA ***/
				
				
				echo '<div class="alert alert-success" role="alert">Contacto y subcontactos eliminados satisfactoriamente!</div>';	
				
			}

			break;
			
		case "program" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs WHERE program_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete itinerary if exist */
				
				$stmt = $db->prepare( "DELETE FROM programs_itineraries WHERE iti_prog_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete extensions if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_extensions WHERE ext_program = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete hotels if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_hotels WHERE hotel_prog = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete extra info if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_extrainfo WHERE prog_ext_prog = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete included info if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_included WHERE prog_inc_prog = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete not included info if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_notincluded WHERE prog_inc_prog = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				/* delete rates if exist */
				
				$stmt = $db->prepare( "DELETE FROM dir_programs_rates WHERE program_rates_program = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();
				
				echo '<div class="alert alert-success" role="alert">Programa eliminado satisfactoriamente!</div>';	
				
			}

			break;
			
		case "extension" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_extensions WHERE ext_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();				
				
				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_extensions_disp.php";

			}

			break;
			
		case "delfolder" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];				

				/* conect FTP */

				$stmt_conf = $db->prepare('SELECT ftp_username2, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username2'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		

				/*** delete all files on that folder via FTP  ***/	
				
				$stmt = $db->prepare('SELECT * FROM dir_contacts_folders_docs WHERE doc_folder = :doc_folder');	
				$stmt->execute(array(':doc_folder' => $rowid));
				
				while ($rowfile = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$fileid = $rowfile['doc_id'];
					$filename = $rowfile['doc_name'];
					
					$stmt2 = $db->prepare( "DELETE FROM dir_contacts_folders_docs WHERE doc_id = :id" );
					$stmt2->bindParam(':id', $fileid);
					$stmt2->execute();

					$ftp_server = "ftp.nddinfosystems.com";
					$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
					$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
					
					// delete file from server
				
					ftp_delete($ftp_conn, $filename);

					// close connection
					
					ftp_close($ftp_conn);
					
				}
				
				/* after deleteing all files in folder, proceed to delete folder */

				$stmt = $db->prepare( "DELETE FROM dir_contacts_folders WHERE fold_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				echo '<div class="alert alert-success" role="alert">Carpeta eliminada satisfactoriamente!</div>';	
				
			}

			break;	
			
		case "delfile" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT doc_name FROM dir_contacts_folders_docs WHERE doc_id = :doc_id');	
				$stmt->execute(array(':doc_id' => $rowid));
				$rowfile = $stmt->fetch(PDO::FETCH_ASSOC);
				
				$filename = $rowfile['doc_name'];				
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username2, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username2'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete filr from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				$stmt2 = $db->prepare( "DELETE FROM dir_contacts_folders_docs WHERE doc_id = :doc_id" );
				$stmt2->bindParam(':doc_id', $rowid);
				$stmt2->execute();
		
				echo '<div class="alert alert-success" role="alert">Documento eliminado satisfactoriamente!</div>';				
				
			}

			break;	
	
		case "carrimage" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];
				$rowprg = $_POST['rowprg'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT program_banner1, program_banner2, program_banner3, program_banner4 FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowprg));	
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($rowid == 1)				
					$filename = $rrows['program_banner1'];
				elseif ($rowid == 2)				
					$filename = $rrows['program_banner2'];	
				elseif ($rowid == 3)				
					$filename = $rrows['program_banner3'];
				if ($rowid == 4)				
					$filename = $rrows['program_banner4'];	
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username3, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username3'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete file from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				if ($rowid == 1)				
					$stmt2 = $db->prepare( "UPDATE dir_programs SET program_banner1 = :program_banner, program_banner_cap1 = :program_banner_cap WHERE program_id = :program_id" );
				elseif ($rowid == 2)
					$stmt2 = $db->prepare( "UPDATE dir_programs SET program_banner2 = :program_banner, program_banner_cap2 = :program_banner_cap WHERE program_id = :program_id" );
				elseif ($rowid == 3)
					$stmt2 = $db->prepare( "UPDATE dir_programs SET program_banner3 = :program_banner, program_banner_cap3 = :program_banner_cap WHERE program_id = :program_id" );
				elseif ($rowid == 4)
					$stmt2 = $db->prepare( "UPDATE dir_programs SET program_banner4 = :program_banner, program_banner_cap4 = :program_banner_cap WHERE program_id = :program_id" );
				
				$stmt2->bindValue(':program_banner', null);
				$stmt2->bindValue(':program_banner_cap', null);
				$stmt2->bindParam(':program_id', $rowprg);
				$stmt2->execute();
		
				/* retrieve info from table */
	
				$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowprg));
				
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
				
				/* refresh div */
				
				include "admin_program_view_disp_imgcar.php";
				
			}

			break;	

		case "ribbons" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT ribbon_file FROM dir_ribbons WHERE ribbon_id = :ribbon_id');	
				$stmt->execute(array(':ribbon_id' => $rowid));	
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

				$filename = $rrows['ribbon_file'];
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username7, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username7'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete file from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				$stmt2 = $db->prepare( "DELETE FROM dir_ribbons WHERE ribbon_id = :ribbon_id" );

				$stmt2->bindParam(':ribbon_id', $rowid);
				$stmt2->execute();
				
				/* refresh div */
				
				include "admin_program_ribbons_disp.php";
				
			}

			break;

		case "thumbimage" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];
				$rowprg = $_POST['rowprg'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT program_thumb_image FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowid));	
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

				$filename = $rrows['program_thumb_image'];
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username4, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username4'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete file from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				$stmt2 = $db->prepare( "UPDATE dir_programs SET program_thumb_image = :program_thumb_image WHERE program_id = :program_id" );

				$stmt2->bindValue(':program_thumb_image', null);
				$stmt2->bindParam(':program_id', $rowid);
				$stmt2->execute();
		
				/* retrieve info from table */
	
				$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowid));
				
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
				
				/* refresh div */
				
				include "admin_program_view_disp_thumb.php";
				
			}

			break;	

		case "mapimage" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];
				$rowprg = $_POST['rowprg'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT program_map1 FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowid));	
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

				$filename = $rrows['program_map1'];
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username5, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username5'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete file from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				$stmt2 = $db->prepare( "UPDATE dir_programs SET program_map1 = :program_map1 WHERE program_id = :program_id" );

				$stmt2->bindValue(':program_map1', null);
				$stmt2->bindParam(':program_id', $rowid);
				$stmt2->execute();
		
				/* retrieve info from table */
	
				$stmt = $db->prepare('SELECT * FROM dir_programs WHERE program_id = :program_id');	
				$stmt->execute(array(':program_id' => $rowid));
				
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
				
				/* refresh div */
				
				include "admin_program_view_disp_map.php";
				
			}

			break;		

		case "ext" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				/* retrieve name of file to delete */				
				
				$stmt = $db->prepare('SELECT ext_image FROM dir_programs_extensions WHERE ext_id = :ext_id');	
				$stmt->execute(array(':ext_id' => $rowid));	
				$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

				$filename = $rrows['ext_image'];
				
				/* connect FTP */	

				$stmt_conf = $db->prepare('SELECT ftp_username6, ftp_userpass2 FROM config');	
				$stmt_conf->execute();
				$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
				
				$ftp_username = $row_conf['ftp_username6'];
				$ftp_userpass = $row_conf['ftp_userpass2'];		
				
				/* delete file from server */
				
				$ftp_server = "ftp.nddinfosystems.com";
				$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
				$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
				
				/* delete file from server */
			
				ftp_delete($ftp_conn, $filename);

				/* close connection */
				
				ftp_close($ftp_conn);
				
				/* delete file name from dn */

				$stmt2 = $db->prepare( "UPDATE dir_programs_extensions SET ext_image = :ext_image WHERE ext_id = :ext_id" );

				$stmt2->bindValue(':ext_image', null);
				$stmt2->bindParam(':ext_id', $rowid);
				$stmt2->execute();
		
				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_extensions_disp.php";
				
			}

			break;
			
		case "hotel" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_hotels WHERE hotel_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_hotels_disp.php";
				
			}

			break;		
		
		case "rate" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_rates WHERE program_rates_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_rates_disp.php";
				
			}

			break;
			
		case "included" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_included WHERE prog_inc_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_includes_disp.php";
				
			}

			break;
			
		case "notincluded" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_notincluded WHERE prog_inc_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_notincludes_disp.php";
				
			}

			break;

		case "infoextra" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM dir_programs_extrainfo WHERE prog_ext_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_program_extrainfo_disp.php";
				
			}

			break;			
			
		case "itinerary" :

			if($_POST['rowid']) {
				
				$rowid = $_POST['rowid'];

				$stmt = $db->prepare( "DELETE FROM programs_itineraries WHERE iti_id = :id" );
				$stmt->bindParam(':id', $rowid);
				$stmt->execute();

				$prog_id = $_POST['rowprg'];
				
				/* refresh div */
				
				include "admin_itinerary_disp.php";
				
			}

			break;

		case "ticker" :

			$rowid = 1;

			/* retrieve name of file to delete */				
			
			$stmt = $db->prepare('SELECT ticker_img FROM config WHERE config_id = :config_id');	
			$stmt->execute(array(':config_id' => $rowid));	
			$rrows = $stmt->fetch(PDO::FETCH_ASSOC);

			$filename = $rrows['ticker_img'];

			/* connect FTP */	

			$stmt_conf = $db->prepare('SELECT ftp_username8, ftp_userpass2 FROM config');	
			$stmt_conf->execute();
			$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	
			
			$ftp_username = $row_conf['ftp_username8'];
			$ftp_userpass = $row_conf['ftp_userpass2'];		
			
			/* delete file from server */
			
			$ftp_server = "ftp.nddinfosystems.com";
			$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
			$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
			
			/* delete file from server */
		
			ftp_delete($ftp_conn, $filename);

			/* close connection */
			
			ftp_close($ftp_conn);

			/* update file name with null */

			$stmt2 = $db->prepare( "UPDATE config SET ticker_img = :ticker_img WHERE config_id = :config_id" );

			$stmt2->bindValue(':ticker_img', null);
			$stmt2->bindParam(':config_id', $rowid);
			$stmt2->execute();
	
			break;

	}
	
?>