<?php

	/* include config */
	
	require_once('includes/config.php');
	
	/* if not logged in redirect to login page */
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	/* receive vars */
	
	$contact_id = $_REQUEST['contact_id'];
	
	/* retrieve info from table */
	
	$stmt = $db->prepare('SELECT * FROM dir_contacts WHERE contact_id = :contact_id');	
	$stmt->execute(array(':contact_id' => $contact_id));
	
	$rrows = $stmt->fetch(PDO::FETCH_ASSOC);
	
	/* general vars */
	
	$ctc_type = $rrows['contact_classif2'];	
	
	/* define page title */
	
	$title = $rrows['contact_name'] . " " . $rrows['contact_lastname'];
	
	/* save new contact */

	if($_POST['addsubcontact'] == "save") {
		
		$stmt = $db->prepare('INSERT INTO dir_subcontacts (subcontact_contact, subcontact_name, subcontact_lastname, subcontact_alias, subcontact_phone, subcontact_email, subcontact_dob, subcontact_nationality, subcontact_dni, subcontact_dni_exp, subcontact_pass_num, subcontact_pass_exp, subcontact_notes, subcontact_newsletter1, subcontact_newsletter2) VALUES (:subcontact_contact, :subcontact_name, :subcontact_lastname, :subcontact_alias, :subcontact_phone, :subcontact_email, :subcontact_dob, :subcontact_nationality, :subcontact_dni, :subcontact_dni_exp, :subcontact_pass_num, :subcontact_pass_exp, :subcontact_notes, :subcontact_newsletter1, :subcontact_newsletter2)');
		
		$stmt->bindParam(':subcontact_contact', $_POST['subcontact_contact']);
		$stmt->bindParam(':subcontact_name', $_POST['subcontact_name']);
		$stmt->bindParam(':subcontact_lastname', $_POST['subcontact_lastname']);
		$stmt->bindParam(':subcontact_alias', $_POST['subcontact_alias']);				
		$stmt->bindParam(':subcontact_phone', $_POST['subcontact_phone']);
		$stmt->bindParam(':subcontact_email', $_POST['subcontact_email']);
		$stmt->bindParam(':subcontact_dob', $_POST['subcontact_dob']);		
		$stmt->bindParam(':subcontact_nationality', $_POST['subcontact_nationality']);		
		$stmt->bindParam(':subcontact_dni', $_POST['subcontact_dni']);
		$stmt->bindParam(':subcontact_dni_exp', $_POST['subcontact_dni_exp']);
		$stmt->bindParam(':subcontact_pass_num', $_POST['subcontact_pass_num']);
		$stmt->bindParam(':subcontact_pass_exp', $_POST['subcontact_pass_exp']);
		$stmt->bindParam(':subcontact_notes', $_POST['subcontact_notes']);		
		$stmt->bindParam(':subcontact_newsletter1', $_POST['subcontact_newsletter1']);
		$stmt->bindParam(':subcontact_newsletter2', $_POST['subcontact_newsletter2']);	
	
		$stmt->execute();							

		header("Location: dir_contacts_view?contact_id=$_POST[subcontact_contact]");		
		
	}

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		
		<!-- meta tags -->
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- favicon -->
		
		<link rel="apple-touch-icon" sizes="180x180" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="images/logos/favicon.png">
		<link rel="icon" type="image/png" sizes="16x16" href="images/logos/favicon.png">	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  	
		
		<!-- Bootstrap CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/379421e620.js" crossorigin="anonymous"></script>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i|Playfair+Display&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		<!-- custom CSS -->
	
		<link href="css/styles.css" rel="stylesheet">
		
		<!-- datepicker -->
		
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/jquery-ui-i18n.min.js"></script>
		
		<!-- title -->

		<title><?php echo $title; ?></title>
		
	</head>
	
	<body>
	
		<!-- top navbar -->
		
		<?php include ("navbar.php"); ?>	
		
		<!-- sidebar and main content -->
		
		<div class="row" id="body-row">			
			
			<?php include ("navbar_side.php"); ?>			

			<div class="col mb-5">
				 
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">		
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">								
							<li class="breadcrumb-item"><a href="home">Dashboard</a></li>
							<li class="breadcrumb-item"><a href="dir_contacts">Directorio de contactos</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
						</ol>
					</nav>							
				</div>
					
				<div class="row">
				
					<div class="col-lg-6 col-md-12">							
				
						<div id="general_info">								
						
							<?php include 'dir_contacts_general_info_disp.php'; ?>				
						
						</div>													

					</div>
					
					<div class="col col-lg-6 col-md-12">							
					
						<div id="other_info">
						
							<?php include 'dir_contacts_specific_disp.php'; ?>				
						
						</div>		
					
					</div>
					
				</div>	

				<?php if ($_SESSION['level'] > 1) { ?>				

					<div class="row">
					
						<div class="col col-lg-6 col-md-12">	
						
							<!-- folder documents -->
							
							<div id="cloud_docs">								
							
								<?php include 'dir_contacts_cloud.php'; ?>				
							
							</div>	
					
						</div>
						
					</div>
					
				<?php } ?>		
				
			</div>	
			
			<!-- footer -->	
					
			<?php include ("footer.php"); ?>	
				
		</div>		

		<!-- MODALS -->
		
		<!-- Edit General Contact Info -->
		
		<div class="modal fade" id="editcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">	
		
			<div class="modal-dialog modal-lg" role="document">	
			
				<div class="modal-content">	
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Contacto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>		
					
					<form id="form_editcontact" method="post" autocomplete="off">	

						<div class="modal-body">	
						
							<div class="form-row">
								<div class="col">
									<label for="contact_classif0" class="col-form-label">Clasificación 1-A:</label>
									<select class="custom-select mr-sm-2" id="contact_classif0" name="contact_classif0" required>
										<option value="TRA">Travelnor</option>
										<option value="CUC">Cucoa</option>
									</select>
								</div>
								<div class="col">
									<label for="contact_classif1" class="col-form-label">Clasificación 1-B:</label>
									<select class="custom-select mr-sm-2" id="contact_classif1" name="contact_classif1">
										<option disabled selected>Selecciona...</option>
										<option value="TRA">Travelnor</option>
										<option value="CUC">Cucoa</option>
									</select>
								</div>
								<div class="col">
									<label for="contact_classif2" class="col-form-label">Clasificación 2:</label>
									<select class="custom-select mr-sm-2" id="contact_classif2" name="contact_classif2">
										<option value="CLI">Cliente</option>
										<option value="PRO">Proveedor</option>
										<option value="GES">Gestión</option>
									 </select>
								</div>
							</div>

							<div class="form-row">								
								<div class="col">
									<label for="contact_name" class="col-form-label">Nombre :</label>
									<input type="text" id="contact_name" name="contact_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="contact_lastname" class="col-form-label">Apellido :</label>
									<input type="text" id="contact_lastname" name="contact_lastname" class="form-control">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="contact_alias" class="col-form-label">Alias:</label>
									<input type="text" id="contact_alias" name="contact_alias" class="form-control">
								</div>
							</div>							

							<div class="form-row">								
								<div class="col">
									<label for="contact_address1" class="col-form-label">Dirección:</label>
									<input type="text" id="contact_address1" name="contact_address1" class="form-control">
									<input type="text" id="contact_address2" name="contact_address2" class="form-control mt-3">
								</div>
							</div>	

							<div class="form-row">								
								<div class="col">
									<label for="contact_city" class="col-form-label">Ciudad:</label>
									<input type="text" id="contact_city" name="contact_city" class="form-control">
								</div>						
								<div class="col">
									<label for="contact_pc" class="col-form-label">Código Postal:</label>
									<input type="text" id="contact_pc" name="contact_pc" class="form-control">
								</div>
								<div class="col">
									<label for="contact_country" class="col-form-label">País:</label>
									<select class="custom-select mr-sm-2" id="contact_country" name="contact_country">>
										<option value="AFG">Afghanistan</option>
										<option value="ALA">Åland Islands</option>
										<option value="ALB">Albania</option>
										<option value="DZA">Algeria</option>
										<option value="ASM">American Samoa</option>
										<option value="AND">Andorra</option>
										<option value="AGO">Angola</option>
										<option value="AIA">Anguilla</option>
										<option value="ATA">Antarctica</option>
										<option value="ATG">Antigua and Barbuda</option>
										<option value="ARG">Argentina</option>
										<option value="ARM">Armenia</option>
										<option value="ABW">Aruba</option>
										<option value="AUS">Australia</option>
										<option value="AUT">Austria</option>
										<option value="AZE">Azerbaijan</option>
										<option value="BHS">Bahamas</option>
										<option value="BHR">Bahrain</option>
										<option value="BGD">Bangladesh</option>
										<option value="BRB">Barbados</option>
										<option value="BLR">Belarus</option>
										<option value="BEL">Belgium</option>
										<option value="BLZ">Belize</option>
										<option value="BEN">Benin</option>
										<option value="BMU">Bermuda</option>
										<option value="BTN">Bhutan</option>
										<option value="BOL">Bolivia, Plurinational State of</option>
										<option value="BES">Bonaire, Sint Eustatius and Saba</option>
										<option value="BIH">Bosnia and Herzegovina</option>
										<option value="BWA">Botswana</option>
										<option value="BVT">Bouvet Island</option>
										<option value="BRA">Brazil</option>
										<option value="IOT">British Indian Ocean Territory</option>
										<option value="BRN">Brunei Darussalam</option>
										<option value="BGR">Bulgaria</option>
										<option value="BFA">Burkina Faso</option>
										<option value="BDI">Burundi</option>
										<option value="KHM">Cambodia</option>
										<option value="CMR">Cameroon</option>
										<option value="CAN">Canada</option>
										<option value="CPV">Cape Verde</option>
										<option value="CYM">Cayman Islands</option>
										<option value="CAF">Central African Republic</option>
										<option value="TCD">Chad</option>
										<option value="CHL">Chile</option>
										<option value="CHN">China</option>
										<option value="CXR">Christmas Island</option>
										<option value="CCK">Cocos (Keeling) Islands</option>
										<option value="COL">Colombia</option>
										<option value="COM">Comoros</option>
										<option value="COG">Congo</option>
										<option value="COD">Congo, the Democratic Republic of the</option>
										<option value="COK">Cook Islands</option>
										<option value="CRI">Costa Rica</option>
										<option value="CIV">Côte d'Ivoire</option>
										<option value="HRV">Croatia</option>
										<option value="CUB">Cuba</option>
										<option value="CUW">Curaçao</option>
										<option value="CYP">Cyprus</option>
										<option value="CZE">Czech Republic</option>
										<option value="DNK">Denmark</option>
										<option value="DJI">Djibouti</option>
										<option value="DMA">Dominica</option>
										<option value="DOM">Dominican Republic</option>
										<option value="ECU">Ecuador</option>
										<option value="EGY">Egypt</option>
										<option value="SLV">El Salvador</option>
										<option value="GNQ">Equatorial Guinea</option>
										<option value="ERI">Eritrea</option>
										<option value="EST">Estonia</option>
										<option value="ETH">Ethiopia</option>
										<option value="FLK">Falkland Islands (Malvinas)</option>
										<option value="FRO">Faroe Islands</option>
										<option value="FJI">Fiji</option>
										<option value="FIN">Finland</option>
										<option value="FRA">France</option>
										<option value="GUF">French Guiana</option>
										<option value="PYF">French Polynesia</option>
										<option value="ATF">French Southern Territories</option>
										<option value="GAB">Gabon</option>
										<option value="GMB">Gambia</option>
										<option value="GEO">Georgia</option>
										<option value="DEU">Germany</option>
										<option value="GHA">Ghana</option>
										<option value="GIB">Gibraltar</option>
										<option value="GRC">Greece</option>
										<option value="GRL">Greenland</option>
										<option value="GRD">Grenada</option>
										<option value="GLP">Guadeloupe</option>
										<option value="GUM">Guam</option>
										<option value="GTM">Guatemala</option>
										<option value="GGY">Guernsey</option>
										<option value="GIN">Guinea</option>
										<option value="GNB">Guinea-Bissau</option>
										<option value="GUY">Guyana</option>
										<option value="HTI">Haiti</option>
										<option value="HMD">Heard Island and McDonald Islands</option>
										<option value="VAT">Holy See (Vatican City State)</option>
										<option value="HND">Honduras</option>
										<option value="HKG">Hong Kong</option>
										<option value="HUN">Hungary</option>
										<option value="ISL">Iceland</option>
										<option value="IND">India</option>
										<option value="IDN">Indonesia</option>
										<option value="IRN">Iran, Islamic Republic of</option>
										<option value="IRQ">Iraq</option>
										<option value="IRL">Ireland</option>
										<option value="IMN">Isle of Man</option>
										<option value="ISR">Israel</option>
										<option value="ITA">Italy</option>
										<option value="JAM">Jamaica</option>
										<option value="JPN">Japan</option>
										<option value="JEY">Jersey</option>
										<option value="JOR">Jordan</option>
										<option value="KAZ">Kazakhstan</option>
										<option value="KEN">Kenya</option>
										<option value="KIR">Kiribati</option>
										<option value="PRK">Korea, Democratic People's Republic of</option>
										<option value="KOR">Korea, Republic of</option>
										<option value="KWT">Kuwait</option>
										<option value="KGZ">Kyrgyzstan</option>
										<option value="LAO">Lao People's Democratic Republic</option>
										<option value="LVA">Latvia</option>
										<option value="LBN">Lebanon</option>
										<option value="LSO">Lesotho</option>
										<option value="LBR">Liberia</option>
										<option value="LBY">Libya</option>
										<option value="LIE">Liechtenstein</option>
										<option value="LTU">Lithuania</option>
										<option value="LUX">Luxembourg</option>
										<option value="MAC">Macao</option>
										<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
										<option value="MDG">Madagascar</option>
										<option value="MWI">Malawi</option>
										<option value="MYS">Malaysia</option>
										<option value="MDV">Maldives</option>
										<option value="MLI">Mali</option>
										<option value="MLT">Malta</option>
										<option value="MHL">Marshall Islands</option>
										<option value="MTQ">Martinique</option>
										<option value="MRT">Mauritania</option>
										<option value="MUS">Mauritius</option>
										<option value="MYT">Mayotte</option>
										<option value="MEX">Mexico</option>
										<option value="FSM">Micronesia, Federated States of</option>
										<option value="MDA">Moldova, Republic of</option>
										<option value="MCO">Monaco</option>
										<option value="MNG">Mongolia</option>
										<option value="MNE">Montenegro</option>
										<option value="MSR">Montserrat</option>
										<option value="MAR">Morocco</option>
										<option value="MOZ">Mozambique</option>
										<option value="MMR">Myanmar</option>
										<option value="NAM">Namibia</option>
										<option value="NRU">Nauru</option>
										<option value="NPL">Nepal</option>
										<option value="NLD">Netherlands</option>
										<option value="NCL">New Caledonia</option>
										<option value="NZL">New Zealand</option>
										<option value="NIC">Nicaragua</option>
										<option value="NER">Niger</option>
										<option value="NGA">Nigeria</option>
										<option value="NIU">Niue</option>
										<option value="NFK">Norfolk Island</option>
										<option value="MNP">Northern Mariana Islands</option>
										<option value="NOR">Norway</option>
										<option value="OMN">Oman</option>
										<option value="PAK">Pakistan</option>
										<option value="PLW">Palau</option>
										<option value="PSE">Palestinian Territory, Occupied</option>
										<option value="PAN">Panama</option>
										<option value="PNG">Papua New Guinea</option>
										<option value="PRY">Paraguay</option>
										<option value="PER">Peru</option>
										<option value="PHL">Philippines</option>
										<option value="PCN">Pitcairn</option>
										<option value="POL">Poland</option>
										<option value="PRT">Portugal</option>
										<option value="PRI">Puerto Rico</option>
										<option value="QAT">Qatar</option>
										<option value="REU">Réunion</option>
										<option value="ROU">Romania</option>
										<option value="RUS">Russian Federation</option>
										<option value="RWA">Rwanda</option>
										<option value="BLM">Saint Barthélemy</option>
										<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="KNA">Saint Kitts and Nevis</option>
										<option value="LCA">Saint Lucia</option>
										<option value="MAF">Saint Martin (French part)</option>
										<option value="SPM">Saint Pierre and Miquelon</option>
										<option value="VCT">Saint Vincent and the Grenadines</option>
										<option value="WSM">Samoa</option>
										<option value="SMR">San Marino</option>
										<option value="STP">Sao Tome and Principe</option>
										<option value="SAU">Saudi Arabia</option>
										<option value="SEN">Senegal</option>
										<option value="SRB">Serbia</option>
										<option value="SYC">Seychelles</option>
										<option value="SLE">Sierra Leone</option>
										<option value="SGP">Singapore</option>
										<option value="SXM">Sint Maarten (Dutch part)</option>
										<option value="SVK">Slovakia</option>
										<option value="SVN">Slovenia</option>
										<option value="SLB">Solomon Islands</option>
										<option value="SOM">Somalia</option>
										<option value="ZAF">South Africa</option>
										<option value="SGS">South Georgia and the South Sandwich Islands</option>
										<option value="SSD">South Sudan</option>
										<option value="ESP">Spain</option>
										<option value="LKA">Sri Lanka</option>
										<option value="SDN">Sudan</option>
										<option value="SUR">Suriname</option>
										<option value="SJM">Svalbard and Jan Mayen</option>
										<option value="SWZ">Swaziland</option>
										<option value="SWE">Sweden</option>
										<option value="CHE">Switzerland</option>
										<option value="SYR">Syrian Arab Republic</option>
										<option value="TWN">Taiwan, Province of China</option>
										<option value="TJK">Tajikistan</option>
										<option value="TZA">Tanzania, United Republic of</option>
										<option value="THA">Thailand</option>
										<option value="TLS">Timor-Leste</option>
										<option value="TGO">Togo</option>
										<option value="TKL">Tokelau</option>
										<option value="TON">Tonga</option>
										<option value="TTO">Trinidad and Tobago</option>
										<option value="TUN">Tunisia</option>
										<option value="TUR">Turkey</option>
										<option value="TKM">Turkmenistan</option>
										<option value="TCA">Turks and Caicos Islands</option>
										<option value="TUV">Tuvalu</option>
										<option value="UGA">Uganda</option>
										<option value="UKR">Ukraine</option>
										<option value="ARE">United Arab Emirates</option>
										<option value="GBR">United Kingdom</option>
										<option value="USA">United States</option>
										<option value="UMI">United States Minor Outlying Islands</option>
										<option value="URY">Uruguay</option>
										<option value="UZB">Uzbekistan</option>
										<option value="VUT">Vanuatu</option>
										<option value="VEN">Venezuela, Bolivarian Republic of</option>
										<option value="VNM">Viet Nam</option>
										<option value="VGB">Virgin Islands, British</option>
										<option value="VIR">Virgin Islands, U.S.</option>
										<option value="WLF">Wallis and Futuna</option>
										<option value="ESH">Western Sahara</option>
										<option value="YEM">Yemen</option>
										<option value="ZMB">Zambia</option>
										<option value="ZWE">Zimbabwe</option>
									</select>
								</div>
							</div>								
							
							<div class="form-row">								
								<div class="col">
									<label for="contact_phone" class="col-form-label">Teléfono 1:</label>
									<input type="text" id="contact_phone" name="contact_phone" class="form-control">
								</div>
								<div class="col">
									<label for="contact_fax" class="col-form-label">Teléfono 2:</label>
									<input type="text" id="contact_fax" name="contact_fax" class="form-control">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="contact_email" class="col-form-label">Email:</label>
									<input type="email" id="contact_email" name="contact_email" class="form-control">
								</div>
							</div>	

							<!-- fields for CLI only -->
							
							<div class="form-group" id="fields_cli">
							
								<div class="form-row">								
									<div class="col">
										<label for="contact_dob" class="col-form-label">Fecha de Nacimiento:</label>
										<input type="text" id="contact_dob" name="contact_dob" class="form-control datepicker">
									</div>
									<div class="col">
										<label for="contact_nationality" class="col-form-label">Nacionalidad:</label>
										<select class="custom-select mr-sm-2" id="contact_nationality" name="contact_nationality">
											<option value="AFG">Afghanistan</option>
											<option value="ALA">Åland Islands</option>
											<option value="ALB">Albania</option>
											<option value="DZA">Algeria</option>
											<option value="ASM">American Samoa</option>
											<option value="AND">Andorra</option>
											<option value="AGO">Angola</option>
											<option value="AIA">Anguilla</option>
											<option value="ATA">Antarctica</option>
											<option value="ATG">Antigua and Barbuda</option>
											<option value="ARG">Argentina</option>
											<option value="ARM">Armenia</option>
											<option value="ABW">Aruba</option>
											<option value="AUS">Australia</option>
											<option value="AUT">Austria</option>
											<option value="AZE">Azerbaijan</option>
											<option value="BHS">Bahamas</option>
											<option value="BHR">Bahrain</option>
											<option value="BGD">Bangladesh</option>
											<option value="BRB">Barbados</option>
											<option value="BLR">Belarus</option>
											<option value="BEL">Belgium</option>
											<option value="BLZ">Belize</option>
											<option value="BEN">Benin</option>
											<option value="BMU">Bermuda</option>
											<option value="BTN">Bhutan</option>
											<option value="BOL">Bolivia, Plurinational State of</option>
											<option value="BES">Bonaire, Sint Eustatius and Saba</option>
											<option value="BIH">Bosnia and Herzegovina</option>
											<option value="BWA">Botswana</option>
											<option value="BVT">Bouvet Island</option>
											<option value="BRA">Brazil</option>
											<option value="IOT">British Indian Ocean Territory</option>
											<option value="BRN">Brunei Darussalam</option>
											<option value="BGR">Bulgaria</option>
											<option value="BFA">Burkina Faso</option>
											<option value="BDI">Burundi</option>
											<option value="KHM">Cambodia</option>
											<option value="CMR">Cameroon</option>
											<option value="CAN">Canada</option>
											<option value="CPV">Cape Verde</option>
											<option value="CYM">Cayman Islands</option>
											<option value="CAF">Central African Republic</option>
											<option value="TCD">Chad</option>
											<option value="CHL">Chile</option>
											<option value="CHN">China</option>
											<option value="CXR">Christmas Island</option>
											<option value="CCK">Cocos (Keeling) Islands</option>
											<option value="COL">Colombia</option>
											<option value="COM">Comoros</option>
											<option value="COG">Congo</option>
											<option value="COD">Congo, the Democratic Republic of the</option>
											<option value="COK">Cook Islands</option>
											<option value="CRI">Costa Rica</option>
											<option value="CIV">Côte d'Ivoire</option>
											<option value="HRV">Croatia</option>
											<option value="CUB">Cuba</option>
											<option value="CUW">Curaçao</option>
											<option value="CYP">Cyprus</option>
											<option value="CZE">Czech Republic</option>
											<option value="DNK">Denmark</option>
											<option value="DJI">Djibouti</option>
											<option value="DMA">Dominica</option>
											<option value="DOM">Dominican Republic</option>
											<option value="ECU">Ecuador</option>
											<option value="EGY">Egypt</option>
											<option value="SLV">El Salvador</option>
											<option value="GNQ">Equatorial Guinea</option>
											<option value="ERI">Eritrea</option>
											<option value="EST">Estonia</option>
											<option value="ETH">Ethiopia</option>
											<option value="FLK">Falkland Islands (Malvinas)</option>
											<option value="FRO">Faroe Islands</option>
											<option value="FJI">Fiji</option>
											<option value="FIN">Finland</option>
											<option value="FRA">France</option>
											<option value="GUF">French Guiana</option>
											<option value="PYF">French Polynesia</option>
											<option value="ATF">French Southern Territories</option>
											<option value="GAB">Gabon</option>
											<option value="GMB">Gambia</option>
											<option value="GEO">Georgia</option>
											<option value="DEU">Germany</option>
											<option value="GHA">Ghana</option>
											<option value="GIB">Gibraltar</option>
											<option value="GRC">Greece</option>
											<option value="GRL">Greenland</option>
											<option value="GRD">Grenada</option>
											<option value="GLP">Guadeloupe</option>
											<option value="GUM">Guam</option>
											<option value="GTM">Guatemala</option>
											<option value="GGY">Guernsey</option>
											<option value="GIN">Guinea</option>
											<option value="GNB">Guinea-Bissau</option>
											<option value="GUY">Guyana</option>
											<option value="HTI">Haiti</option>
											<option value="HMD">Heard Island and McDonald Islands</option>
											<option value="VAT">Holy See (Vatican City State)</option>
											<option value="HND">Honduras</option>
											<option value="HKG">Hong Kong</option>
											<option value="HUN">Hungary</option>
											<option value="ISL">Iceland</option>
											<option value="IND">India</option>
											<option value="IDN">Indonesia</option>
											<option value="IRN">Iran, Islamic Republic of</option>
											<option value="IRQ">Iraq</option>
											<option value="IRL">Ireland</option>
											<option value="IMN">Isle of Man</option>
											<option value="ISR">Israel</option>
											<option value="ITA">Italy</option>
											<option value="JAM">Jamaica</option>
											<option value="JPN">Japan</option>
											<option value="JEY">Jersey</option>
											<option value="JOR">Jordan</option>
											<option value="KAZ">Kazakhstan</option>
											<option value="KEN">Kenya</option>
											<option value="KIR">Kiribati</option>
											<option value="PRK">Korea, Democratic People's Republic of</option>
											<option value="KOR">Korea, Republic of</option>
											<option value="KWT">Kuwait</option>
											<option value="KGZ">Kyrgyzstan</option>
											<option value="LAO">Lao People's Democratic Republic</option>
											<option value="LVA">Latvia</option>
											<option value="LBN">Lebanon</option>
											<option value="LSO">Lesotho</option>
											<option value="LBR">Liberia</option>
											<option value="LBY">Libya</option>
											<option value="LIE">Liechtenstein</option>
											<option value="LTU">Lithuania</option>
											<option value="LUX">Luxembourg</option>
											<option value="MAC">Macao</option>
											<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
											<option value="MDG">Madagascar</option>
											<option value="MWI">Malawi</option>
											<option value="MYS">Malaysia</option>
											<option value="MDV">Maldives</option>
											<option value="MLI">Mali</option>
											<option value="MLT">Malta</option>
											<option value="MHL">Marshall Islands</option>
											<option value="MTQ">Martinique</option>
											<option value="MRT">Mauritania</option>
											<option value="MUS">Mauritius</option>
											<option value="MYT">Mayotte</option>
											<option value="MEX">Mexico</option>
											<option value="FSM">Micronesia, Federated States of</option>
											<option value="MDA">Moldova, Republic of</option>
											<option value="MCO">Monaco</option>
											<option value="MNG">Mongolia</option>
											<option value="MNE">Montenegro</option>
											<option value="MSR">Montserrat</option>
											<option value="MAR">Morocco</option>
											<option value="MOZ">Mozambique</option>
											<option value="MMR">Myanmar</option>
											<option value="NAM">Namibia</option>
											<option value="NRU">Nauru</option>
											<option value="NPL">Nepal</option>
											<option value="NLD">Netherlands</option>
											<option value="NCL">New Caledonia</option>
											<option value="NZL">New Zealand</option>
											<option value="NIC">Nicaragua</option>
											<option value="NER">Niger</option>
											<option value="NGA">Nigeria</option>
											<option value="NIU">Niue</option>
											<option value="NFK">Norfolk Island</option>
											<option value="MNP">Northern Mariana Islands</option>
											<option value="NOR">Norway</option>
											<option value="OMN">Oman</option>
											<option value="PAK">Pakistan</option>
											<option value="PLW">Palau</option>
											<option value="PSE">Palestinian Territory, Occupied</option>
											<option value="PAN">Panama</option>
											<option value="PNG">Papua New Guinea</option>
											<option value="PRY">Paraguay</option>
											<option value="PER">Peru</option>
											<option value="PHL">Philippines</option>
											<option value="PCN">Pitcairn</option>
											<option value="POL">Poland</option>
											<option value="PRT">Portugal</option>
											<option value="PRI">Puerto Rico</option>
											<option value="QAT">Qatar</option>
											<option value="REU">Réunion</option>
											<option value="ROU">Romania</option>
											<option value="RUS">Russian Federation</option>
											<option value="RWA">Rwanda</option>
											<option value="BLM">Saint Barthélemy</option>
											<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
											<option value="KNA">Saint Kitts and Nevis</option>
											<option value="LCA">Saint Lucia</option>
											<option value="MAF">Saint Martin (French part)</option>
											<option value="SPM">Saint Pierre and Miquelon</option>
											<option value="VCT">Saint Vincent and the Grenadines</option>
											<option value="WSM">Samoa</option>
											<option value="SMR">San Marino</option>
											<option value="STP">Sao Tome and Principe</option>
											<option value="SAU">Saudi Arabia</option>
											<option value="SEN">Senegal</option>
											<option value="SRB">Serbia</option>
											<option value="SYC">Seychelles</option>
											<option value="SLE">Sierra Leone</option>
											<option value="SGP">Singapore</option>
											<option value="SXM">Sint Maarten (Dutch part)</option>
											<option value="SVK">Slovakia</option>
											<option value="SVN">Slovenia</option>
											<option value="SLB">Solomon Islands</option>
											<option value="SOM">Somalia</option>
											<option value="ZAF">South Africa</option>
											<option value="SGS">South Georgia and the South Sandwich Islands</option>
											<option value="SSD">South Sudan</option>
											<option value="ESP" selected>Spain</option>
											<option value="LKA">Sri Lanka</option>
											<option value="SDN">Sudan</option>
											<option value="SUR">Suriname</option>
											<option value="SJM">Svalbard and Jan Mayen</option>
											<option value="SWZ">Swaziland</option>
											<option value="SWE">Sweden</option>
											<option value="CHE">Switzerland</option>
											<option value="SYR">Syrian Arab Republic</option>
											<option value="TWN">Taiwan, Province of China</option>
											<option value="TJK">Tajikistan</option>
											<option value="TZA">Tanzania, United Republic of</option>
											<option value="THA">Thailand</option>
											<option value="TLS">Timor-Leste</option>
											<option value="TGO">Togo</option>
											<option value="TKL">Tokelau</option>
											<option value="TON">Tonga</option>
											<option value="TTO">Trinidad and Tobago</option>
											<option value="TUN">Tunisia</option>
											<option value="TUR">Turkey</option>
											<option value="TKM">Turkmenistan</option>
											<option value="TCA">Turks and Caicos Islands</option>
											<option value="TUV">Tuvalu</option>
											<option value="UGA">Uganda</option>
											<option value="UKR">Ukraine</option>
											<option value="ARE">United Arab Emirates</option>
											<option value="GBR">United Kingdom</option>
											<option value="USA">United States</option>
											<option value="UMI">United States Minor Outlying Islands</option>
											<option value="URY">Uruguay</option>
											<option value="UZB">Uzbekistan</option>
											<option value="VUT">Vanuatu</option>
											<option value="VEN">Venezuela, Bolivarian Republic of</option>
											<option value="VNM">Viet Nam</option>
											<option value="VGB">Virgin Islands, British</option>
											<option value="VIR">Virgin Islands, U.S.</option>
											<option value="WLF">Wallis and Futuna</option>
											<option value="ESH">Western Sahara</option>
											<option value="YEM">Yemen</option>
											<option value="ZMB">Zambia</option>
											<option value="ZWE">Zimbabwe</option>
										</select>
									</div>
								</div>	

								<div class="form-row">								
									<div class="col">
										<label for="contact_pass_num" class="col-form-label">Pasaporte No.:</label>
										<input type="text" id="contact_pass_num" name="contact_pass_num" class="form-control">
									</div>
									<div class="col">
										<label for="contact_pass_exp" class="col-form-label">Pasaporte Fecha Expiración:</label>
										<input type="text" id="contact_pass_exp" name="contact_pass_exp" class="form-control datepicker">
									</div>								
								</div>	
								
								<div class="form-row">								
									<div class="col">
										<label for="contact_dni" class="col-form-label">DNI No.:</label>
										<input type="text" id="contact_dni" name="contact_dni" class="form-control">
									</div>
									<div class="col">
										<label for="contact_dni_exp" class="col-form-label">DNI Fecha Expiración:</label>
										<input type="text" id="contact_dni_exp" name="contact_dni_exp" class="form-control datepicker">
									</div>								
								</div>
							
							</div>

							<div class="form-group row mt-3">
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" <?php if ($rrows['contact_newsletter1'] == 1) echo " checked "; ?> type="checkbox" id="contact_newsletter1" value="1" name="contact_newsletter1">
										<label class="form-check-label" for="contact_newsletter1">Newsletter TRA</label>
									</div>
								</div>
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" <?php if ($rrows['contact_newsletter2'] == 1) echo " checked "; ?> type="checkbox" id="contact_newsletter2" value="1" name="contact_newsletter2">
										<label class="form-check-label" for="contact_newsletter2">Newsletter CUC</label>
									</div>
								</div>
							</div>		

							<div class="modal-footer">							
								<input type="hidden" id="contact_id" name="contact_id" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="addcontact" name="addcontact" value="save">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
							
						</div>	
						
					</form>
					
				</div>	
				
			</div>	
			
		</div>
		
		<!-- Add new subcontact modal -->
		
		<div class="modal fade" id="newsubcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Subcontacto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_addsubcontact" method="post" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="subcontact_name" class="col-form-label">Nombre :</label>
									<input type="text" id="subcontact_name" name="subcontact_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="subcontact_lastname" class="col-form-label">Apellido :</label>
									<input type="text" id="subcontact_lastname" name="subcontact_lastname" class="form-control">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="subcontact_alias" class="col-form-label">Alias:</label>
									<input type="text" id="subcontact_alias" name="subcontact_alias" class="form-control">
								</div>
							</div>							

							<div class="form-row">								
								<div class="col">
									<label for="subcontact_phone" class="col-form-label">Teléfono:</label>
									<input type="text" id="subcontact_phone" name="subcontact_phone" class="form-control">
								</div>								
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="subcontact_email" class="col-form-label">Email:</label>
									<input type="email" id="subcontact_email" name="subcontact_email" class="form-control">
								</div>
							</div>							

							<div class="form-row">								
								<div class="col">
									<label for="subcontact_dob" class="col-form-label">Fecha de Nacimiento:</label>
									<input type="text" id="datepicker" name="subcontact_dob" class="form-control datepicker">
								</div>
								<div class="col">
									<label for="subcontact_nationality" class="col-form-label">Nacionalidad:</label>
									<select class="custom-select mr-sm-2" id="subcontact_nationality" name="subcontact_nationality">
										<option value="AFG">Afghanistan</option>
										<option value="ALA">Åland Islands</option>
										<option value="ALB">Albania</option>
										<option value="DZA">Algeria</option>
										<option value="ASM">American Samoa</option>
										<option value="AND">Andorra</option>
										<option value="AGO">Angola</option>
										<option value="AIA">Anguilla</option>
										<option value="ATA">Antarctica</option>
										<option value="ATG">Antigua and Barbuda</option>
										<option value="ARG">Argentina</option>
										<option value="ARM">Armenia</option>
										<option value="ABW">Aruba</option>
										<option value="AUS">Australia</option>
										<option value="AUT">Austria</option>
										<option value="AZE">Azerbaijan</option>
										<option value="BHS">Bahamas</option>
										<option value="BHR">Bahrain</option>
										<option value="BGD">Bangladesh</option>
										<option value="BRB">Barbados</option>
										<option value="BLR">Belarus</option>
										<option value="BEL">Belgium</option>
										<option value="BLZ">Belize</option>
										<option value="BEN">Benin</option>
										<option value="BMU">Bermuda</option>
										<option value="BTN">Bhutan</option>
										<option value="BOL">Bolivia, Plurinational State of</option>
										<option value="BES">Bonaire, Sint Eustatius and Saba</option>
										<option value="BIH">Bosnia and Herzegovina</option>
										<option value="BWA">Botswana</option>
										<option value="BVT">Bouvet Island</option>
										<option value="BRA">Brazil</option>
										<option value="IOT">British Indian Ocean Territory</option>
										<option value="BRN">Brunei Darussalam</option>
										<option value="BGR">Bulgaria</option>
										<option value="BFA">Burkina Faso</option>
										<option value="BDI">Burundi</option>
										<option value="KHM">Cambodia</option>
										<option value="CMR">Cameroon</option>
										<option value="CAN">Canada</option>
										<option value="CPV">Cape Verde</option>
										<option value="CYM">Cayman Islands</option>
										<option value="CAF">Central African Republic</option>
										<option value="TCD">Chad</option>
										<option value="CHL">Chile</option>
										<option value="CHN">China</option>
										<option value="CXR">Christmas Island</option>
										<option value="CCK">Cocos (Keeling) Islands</option>
										<option value="COL">Colombia</option>
										<option value="COM">Comoros</option>
										<option value="COG">Congo</option>
										<option value="COD">Congo, the Democratic Republic of the</option>
										<option value="COK">Cook Islands</option>
										<option value="CRI">Costa Rica</option>
										<option value="CIV">Côte d'Ivoire</option>
										<option value="HRV">Croatia</option>
										<option value="CUB">Cuba</option>
										<option value="CUW">Curaçao</option>
										<option value="CYP">Cyprus</option>
										<option value="CZE">Czech Republic</option>
										<option value="DNK">Denmark</option>
										<option value="DJI">Djibouti</option>
										<option value="DMA">Dominica</option>
										<option value="DOM">Dominican Republic</option>
										<option value="ECU">Ecuador</option>
										<option value="EGY">Egypt</option>
										<option value="SLV">El Salvador</option>
										<option value="GNQ">Equatorial Guinea</option>
										<option value="ERI">Eritrea</option>
										<option value="EST">Estonia</option>
										<option value="ETH">Ethiopia</option>
										<option value="FLK">Falkland Islands (Malvinas)</option>
										<option value="FRO">Faroe Islands</option>
										<option value="FJI">Fiji</option>
										<option value="FIN">Finland</option>
										<option value="FRA">France</option>
										<option value="GUF">French Guiana</option>
										<option value="PYF">French Polynesia</option>
										<option value="ATF">French Southern Territories</option>
										<option value="GAB">Gabon</option>
										<option value="GMB">Gambia</option>
										<option value="GEO">Georgia</option>
										<option value="DEU">Germany</option>
										<option value="GHA">Ghana</option>
										<option value="GIB">Gibraltar</option>
										<option value="GRC">Greece</option>
										<option value="GRL">Greenland</option>
										<option value="GRD">Grenada</option>
										<option value="GLP">Guadeloupe</option>
										<option value="GUM">Guam</option>
										<option value="GTM">Guatemala</option>
										<option value="GGY">Guernsey</option>
										<option value="GIN">Guinea</option>
										<option value="GNB">Guinea-Bissau</option>
										<option value="GUY">Guyana</option>
										<option value="HTI">Haiti</option>
										<option value="HMD">Heard Island and McDonald Islands</option>
										<option value="VAT">Holy See (Vatican City State)</option>
										<option value="HND">Honduras</option>
										<option value="HKG">Hong Kong</option>
										<option value="HUN">Hungary</option>
										<option value="ISL">Iceland</option>
										<option value="IND">India</option>
										<option value="IDN">Indonesia</option>
										<option value="IRN">Iran, Islamic Republic of</option>
										<option value="IRQ">Iraq</option>
										<option value="IRL">Ireland</option>
										<option value="IMN">Isle of Man</option>
										<option value="ISR">Israel</option>
										<option value="ITA">Italy</option>
										<option value="JAM">Jamaica</option>
										<option value="JPN">Japan</option>
										<option value="JEY">Jersey</option>
										<option value="JOR">Jordan</option>
										<option value="KAZ">Kazakhstan</option>
										<option value="KEN">Kenya</option>
										<option value="KIR">Kiribati</option>
										<option value="PRK">Korea, Democratic People's Republic of</option>
										<option value="KOR">Korea, Republic of</option>
										<option value="KWT">Kuwait</option>
										<option value="KGZ">Kyrgyzstan</option>
										<option value="LAO">Lao People's Democratic Republic</option>
										<option value="LVA">Latvia</option>
										<option value="LBN">Lebanon</option>
										<option value="LSO">Lesotho</option>
										<option value="LBR">Liberia</option>
										<option value="LBY">Libya</option>
										<option value="LIE">Liechtenstein</option>
										<option value="LTU">Lithuania</option>
										<option value="LUX">Luxembourg</option>
										<option value="MAC">Macao</option>
										<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
										<option value="MDG">Madagascar</option>
										<option value="MWI">Malawi</option>
										<option value="MYS">Malaysia</option>
										<option value="MDV">Maldives</option>
										<option value="MLI">Mali</option>
										<option value="MLT">Malta</option>
										<option value="MHL">Marshall Islands</option>
										<option value="MTQ">Martinique</option>
										<option value="MRT">Mauritania</option>
										<option value="MUS">Mauritius</option>
										<option value="MYT">Mayotte</option>
										<option value="MEX">Mexico</option>
										<option value="FSM">Micronesia, Federated States of</option>
										<option value="MDA">Moldova, Republic of</option>
										<option value="MCO">Monaco</option>
										<option value="MNG">Mongolia</option>
										<option value="MNE">Montenegro</option>
										<option value="MSR">Montserrat</option>
										<option value="MAR">Morocco</option>
										<option value="MOZ">Mozambique</option>
										<option value="MMR">Myanmar</option>
										<option value="NAM">Namibia</option>
										<option value="NRU">Nauru</option>
										<option value="NPL">Nepal</option>
										<option value="NLD">Netherlands</option>
										<option value="NCL">New Caledonia</option>
										<option value="NZL">New Zealand</option>
										<option value="NIC">Nicaragua</option>
										<option value="NER">Niger</option>
										<option value="NGA">Nigeria</option>
										<option value="NIU">Niue</option>
										<option value="NFK">Norfolk Island</option>
										<option value="MNP">Northern Mariana Islands</option>
										<option value="NOR">Norway</option>
										<option value="OMN">Oman</option>
										<option value="PAK">Pakistan</option>
										<option value="PLW">Palau</option>
										<option value="PSE">Palestinian Territory, Occupied</option>
										<option value="PAN">Panama</option>
										<option value="PNG">Papua New Guinea</option>
										<option value="PRY">Paraguay</option>
										<option value="PER">Peru</option>
										<option value="PHL">Philippines</option>
										<option value="PCN">Pitcairn</option>
										<option value="POL">Poland</option>
										<option value="PRT">Portugal</option>
										<option value="PRI">Puerto Rico</option>
										<option value="QAT">Qatar</option>
										<option value="REU">Réunion</option>
										<option value="ROU">Romania</option>
										<option value="RUS">Russian Federation</option>
										<option value="RWA">Rwanda</option>
										<option value="BLM">Saint Barthélemy</option>
										<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="KNA">Saint Kitts and Nevis</option>
										<option value="LCA">Saint Lucia</option>
										<option value="MAF">Saint Martin (French part)</option>
										<option value="SPM">Saint Pierre and Miquelon</option>
										<option value="VCT">Saint Vincent and the Grenadines</option>
										<option value="WSM">Samoa</option>
										<option value="SMR">San Marino</option>
										<option value="STP">Sao Tome and Principe</option>
										<option value="SAU">Saudi Arabia</option>
										<option value="SEN">Senegal</option>
										<option value="SRB">Serbia</option>
										<option value="SYC">Seychelles</option>
										<option value="SLE">Sierra Leone</option>
										<option value="SGP">Singapore</option>
										<option value="SXM">Sint Maarten (Dutch part)</option>
										<option value="SVK">Slovakia</option>
										<option value="SVN">Slovenia</option>
										<option value="SLB">Solomon Islands</option>
										<option value="SOM">Somalia</option>
										<option value="ZAF">South Africa</option>
										<option value="SGS">South Georgia and the South Sandwich Islands</option>
										<option value="SSD">South Sudan</option>
										<option value="ESP" selected>Spain</option>
										<option value="LKA">Sri Lanka</option>
										<option value="SDN">Sudan</option>
										<option value="SUR">Suriname</option>
										<option value="SJM">Svalbard and Jan Mayen</option>
										<option value="SWZ">Swaziland</option>
										<option value="SWE">Sweden</option>
										<option value="CHE">Switzerland</option>
										<option value="SYR">Syrian Arab Republic</option>
										<option value="TWN">Taiwan, Province of China</option>
										<option value="TJK">Tajikistan</option>
										<option value="TZA">Tanzania, United Republic of</option>
										<option value="THA">Thailand</option>
										<option value="TLS">Timor-Leste</option>
										<option value="TGO">Togo</option>
										<option value="TKL">Tokelau</option>
										<option value="TON">Tonga</option>
										<option value="TTO">Trinidad and Tobago</option>
										<option value="TUN">Tunisia</option>
										<option value="TUR">Turkey</option>
										<option value="TKM">Turkmenistan</option>
										<option value="TCA">Turks and Caicos Islands</option>
										<option value="TUV">Tuvalu</option>
										<option value="UGA">Uganda</option>
										<option value="UKR">Ukraine</option>
										<option value="ARE">United Arab Emirates</option>
										<option value="GBR">United Kingdom</option>
										<option value="USA">United States</option>
										<option value="UMI">United States Minor Outlying Islands</option>
										<option value="URY">Uruguay</option>
										<option value="UZB">Uzbekistan</option>
										<option value="VUT">Vanuatu</option>
										<option value="VEN">Venezuela, Bolivarian Republic of</option>
										<option value="VNM">Viet Nam</option>
										<option value="VGB">Virgin Islands, British</option>
										<option value="VIR">Virgin Islands, U.S.</option>
										<option value="WLF">Wallis and Futuna</option>
										<option value="ESH">Western Sahara</option>
										<option value="YEM">Yemen</option>
										<option value="ZMB">Zambia</option>
										<option value="ZWE">Zimbabwe</option>
									</select>
								</div>
							</div>	

							<div class="form-row">								
								<div class="col">
									<label for="subcontact_pass_num" class="col-form-label">Pasaporte No.:</label>
									<input type="text" id="subcontact_pass_num" name="subcontact_pass_num" class="form-control">
								</div>
								<div class="col">
									<label for="subcontact_pass_exp" class="col-form-label">Pasaporte Fecha Expiración:</label>
									<input type="text" id="subcontact_pass_exp" name="subcontact_pass_exp" class="form-control datepicker">
								</div>								
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="subcontact_dni" class="col-form-label">DNI No.:</label>
									<input type="text" id="subcontact_dni" name="subcontact_dni" class="form-control">
								</div>
								<div class="col">
									<label for="subcontact_dni_exp" class="col-form-label">DNI Fecha Expiración:</label>
									<input type="text" id="subcontact_dni_exp" name="subcontact_dni_exp" class="form-control datepicker">
								</div>								
							</div>	
							
							<div class="form-group row mt-3">
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="subcontact_newsletter1" value="1" name="subcontact_newsletter1">
										<label class="form-check-label" for="subcontact_newsletter1">Newsletter TRA</label>
									</div>
								</div>
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="subcontact_newsletter2" value="1" name="subcontact_newsletter2">
										<label class="form-check-label" for="subcontact_newsletter2">Newsletter CUC</label>
									</div>
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="subcontact_notes" class="col-form-label">Notas:</label>
									<textarea class="form-control" id="subcontact_notes" name="subcontact_notes" rows="3"></textarea>
								</div>
							</div>	
							
							<div class="modal-footer">	
								<input type="hidden" id="subcontact_contact" name="subcontact_contact" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="addsubcontact" name="addsubcontact" value="save">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>
		
		<!-- Edit subcontact modal -->
		
		<div class="modal fade" id="edit_subcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Subcontacto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_editsubcontact" method="post" autocomplete="off">	
					
						<div class="modal-body">	

							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_name" class="col-form-label">Nombre :</label>
									<input type="text" id="xsubcontact_name" name="xsubcontact_name" class="form-control" required>
								</div>
								<div class="col">
									<label for="xsubcontact_lastname" class="col-form-label">Apellido :</label>
									<input type="text" id="xsubcontact_lastname" name="xsubcontact_lastname" class="form-control">
								</div>
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_alias" class="col-form-label">Alias:</label>
									<input type="text" id="xsubcontact_alias" name="xsubcontact_alias" class="form-control">
								</div>
							</div>							

							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_phone" class="col-form-label">Teléfono:</label>
									<input type="text" id="xsubcontact_phone" name="xsubcontact_phone" class="form-control">
								</div>								
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_email" class="col-form-label">Email:</label>
									<input type="email" id="xsubcontact_email" name="xsubcontact_email" class="form-control">
								</div>
							</div>							

							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_dob" class="col-form-label">Fecha de Nacimiento:</label>
									<input type="text" id="xsubcontact_dob" name="xsubcontact_dob" class="form-control datepicker">
								</div>
								<div class="col">
									<label for="xsubcontact_nationality" class="col-form-label">Nacionalidad:</label>
									<select class="custom-select mr-sm-2" id="xsubcontact_nationality" name="xsubcontact_nationality">
										<option value="AFG">Afghanistan</option>
										<option value="ALA">Åland Islands</option>
										<option value="ALB">Albania</option>
										<option value="DZA">Algeria</option>
										<option value="ASM">American Samoa</option>
										<option value="AND">Andorra</option>
										<option value="AGO">Angola</option>
										<option value="AIA">Anguilla</option>
										<option value="ATA">Antarctica</option>
										<option value="ATG">Antigua and Barbuda</option>
										<option value="ARG">Argentina</option>
										<option value="ARM">Armenia</option>
										<option value="ABW">Aruba</option>
										<option value="AUS">Australia</option>
										<option value="AUT">Austria</option>
										<option value="AZE">Azerbaijan</option>
										<option value="BHS">Bahamas</option>
										<option value="BHR">Bahrain</option>
										<option value="BGD">Bangladesh</option>
										<option value="BRB">Barbados</option>
										<option value="BLR">Belarus</option>
										<option value="BEL">Belgium</option>
										<option value="BLZ">Belize</option>
										<option value="BEN">Benin</option>
										<option value="BMU">Bermuda</option>
										<option value="BTN">Bhutan</option>
										<option value="BOL">Bolivia, Plurinational State of</option>
										<option value="BES">Bonaire, Sint Eustatius and Saba</option>
										<option value="BIH">Bosnia and Herzegovina</option>
										<option value="BWA">Botswana</option>
										<option value="BVT">Bouvet Island</option>
										<option value="BRA">Brazil</option>
										<option value="IOT">British Indian Ocean Territory</option>
										<option value="BRN">Brunei Darussalam</option>
										<option value="BGR">Bulgaria</option>
										<option value="BFA">Burkina Faso</option>
										<option value="BDI">Burundi</option>
										<option value="KHM">Cambodia</option>
										<option value="CMR">Cameroon</option>
										<option value="CAN">Canada</option>
										<option value="CPV">Cape Verde</option>
										<option value="CYM">Cayman Islands</option>
										<option value="CAF">Central African Republic</option>
										<option value="TCD">Chad</option>
										<option value="CHL">Chile</option>
										<option value="CHN">China</option>
										<option value="CXR">Christmas Island</option>
										<option value="CCK">Cocos (Keeling) Islands</option>
										<option value="COL">Colombia</option>
										<option value="COM">Comoros</option>
										<option value="COG">Congo</option>
										<option value="COD">Congo, the Democratic Republic of the</option>
										<option value="COK">Cook Islands</option>
										<option value="CRI">Costa Rica</option>
										<option value="CIV">Côte d'Ivoire</option>
										<option value="HRV">Croatia</option>
										<option value="CUB">Cuba</option>
										<option value="CUW">Curaçao</option>
										<option value="CYP">Cyprus</option>
										<option value="CZE">Czech Republic</option>
										<option value="DNK">Denmark</option>
										<option value="DJI">Djibouti</option>
										<option value="DMA">Dominica</option>
										<option value="DOM">Dominican Republic</option>
										<option value="ECU">Ecuador</option>
										<option value="EGY">Egypt</option>
										<option value="SLV">El Salvador</option>
										<option value="GNQ">Equatorial Guinea</option>
										<option value="ERI">Eritrea</option>
										<option value="EST">Estonia</option>
										<option value="ETH">Ethiopia</option>
										<option value="FLK">Falkland Islands (Malvinas)</option>
										<option value="FRO">Faroe Islands</option>
										<option value="FJI">Fiji</option>
										<option value="FIN">Finland</option>
										<option value="FRA">France</option>
										<option value="GUF">French Guiana</option>
										<option value="PYF">French Polynesia</option>
										<option value="ATF">French Southern Territories</option>
										<option value="GAB">Gabon</option>
										<option value="GMB">Gambia</option>
										<option value="GEO">Georgia</option>
										<option value="DEU">Germany</option>
										<option value="GHA">Ghana</option>
										<option value="GIB">Gibraltar</option>
										<option value="GRC">Greece</option>
										<option value="GRL">Greenland</option>
										<option value="GRD">Grenada</option>
										<option value="GLP">Guadeloupe</option>
										<option value="GUM">Guam</option>
										<option value="GTM">Guatemala</option>
										<option value="GGY">Guernsey</option>
										<option value="GIN">Guinea</option>
										<option value="GNB">Guinea-Bissau</option>
										<option value="GUY">Guyana</option>
										<option value="HTI">Haiti</option>
										<option value="HMD">Heard Island and McDonald Islands</option>
										<option value="VAT">Holy See (Vatican City State)</option>
										<option value="HND">Honduras</option>
										<option value="HKG">Hong Kong</option>
										<option value="HUN">Hungary</option>
										<option value="ISL">Iceland</option>
										<option value="IND">India</option>
										<option value="IDN">Indonesia</option>
										<option value="IRN">Iran, Islamic Republic of</option>
										<option value="IRQ">Iraq</option>
										<option value="IRL">Ireland</option>
										<option value="IMN">Isle of Man</option>
										<option value="ISR">Israel</option>
										<option value="ITA">Italy</option>
										<option value="JAM">Jamaica</option>
										<option value="JPN">Japan</option>
										<option value="JEY">Jersey</option>
										<option value="JOR">Jordan</option>
										<option value="KAZ">Kazakhstan</option>
										<option value="KEN">Kenya</option>
										<option value="KIR">Kiribati</option>
										<option value="PRK">Korea, Democratic People's Republic of</option>
										<option value="KOR">Korea, Republic of</option>
										<option value="KWT">Kuwait</option>
										<option value="KGZ">Kyrgyzstan</option>
										<option value="LAO">Lao People's Democratic Republic</option>
										<option value="LVA">Latvia</option>
										<option value="LBN">Lebanon</option>
										<option value="LSO">Lesotho</option>
										<option value="LBR">Liberia</option>
										<option value="LBY">Libya</option>
										<option value="LIE">Liechtenstein</option>
										<option value="LTU">Lithuania</option>
										<option value="LUX">Luxembourg</option>
										<option value="MAC">Macao</option>
										<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
										<option value="MDG">Madagascar</option>
										<option value="MWI">Malawi</option>
										<option value="MYS">Malaysia</option>
										<option value="MDV">Maldives</option>
										<option value="MLI">Mali</option>
										<option value="MLT">Malta</option>
										<option value="MHL">Marshall Islands</option>
										<option value="MTQ">Martinique</option>
										<option value="MRT">Mauritania</option>
										<option value="MUS">Mauritius</option>
										<option value="MYT">Mayotte</option>
										<option value="MEX">Mexico</option>
										<option value="FSM">Micronesia, Federated States of</option>
										<option value="MDA">Moldova, Republic of</option>
										<option value="MCO">Monaco</option>
										<option value="MNG">Mongolia</option>
										<option value="MNE">Montenegro</option>
										<option value="MSR">Montserrat</option>
										<option value="MAR">Morocco</option>
										<option value="MOZ">Mozambique</option>
										<option value="MMR">Myanmar</option>
										<option value="NAM">Namibia</option>
										<option value="NRU">Nauru</option>
										<option value="NPL">Nepal</option>
										<option value="NLD">Netherlands</option>
										<option value="NCL">New Caledonia</option>
										<option value="NZL">New Zealand</option>
										<option value="NIC">Nicaragua</option>
										<option value="NER">Niger</option>
										<option value="NGA">Nigeria</option>
										<option value="NIU">Niue</option>
										<option value="NFK">Norfolk Island</option>
										<option value="MNP">Northern Mariana Islands</option>
										<option value="NOR">Norway</option>
										<option value="OMN">Oman</option>
										<option value="PAK">Pakistan</option>
										<option value="PLW">Palau</option>
										<option value="PSE">Palestinian Territory, Occupied</option>
										<option value="PAN">Panama</option>
										<option value="PNG">Papua New Guinea</option>
										<option value="PRY">Paraguay</option>
										<option value="PER">Peru</option>
										<option value="PHL">Philippines</option>
										<option value="PCN">Pitcairn</option>
										<option value="POL">Poland</option>
										<option value="PRT">Portugal</option>
										<option value="PRI">Puerto Rico</option>
										<option value="QAT">Qatar</option>
										<option value="REU">Réunion</option>
										<option value="ROU">Romania</option>
										<option value="RUS">Russian Federation</option>
										<option value="RWA">Rwanda</option>
										<option value="BLM">Saint Barthélemy</option>
										<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
										<option value="KNA">Saint Kitts and Nevis</option>
										<option value="LCA">Saint Lucia</option>
										<option value="MAF">Saint Martin (French part)</option>
										<option value="SPM">Saint Pierre and Miquelon</option>
										<option value="VCT">Saint Vincent and the Grenadines</option>
										<option value="WSM">Samoa</option>
										<option value="SMR">San Marino</option>
										<option value="STP">Sao Tome and Principe</option>
										<option value="SAU">Saudi Arabia</option>
										<option value="SEN">Senegal</option>
										<option value="SRB">Serbia</option>
										<option value="SYC">Seychelles</option>
										<option value="SLE">Sierra Leone</option>
										<option value="SGP">Singapore</option>
										<option value="SXM">Sint Maarten (Dutch part)</option>
										<option value="SVK">Slovakia</option>
										<option value="SVN">Slovenia</option>
										<option value="SLB">Solomon Islands</option>
										<option value="SOM">Somalia</option>
										<option value="ZAF">South Africa</option>
										<option value="SGS">South Georgia and the South Sandwich Islands</option>
										<option value="SSD">South Sudan</option>
										<option value="ESP" selected>Spain</option>
										<option value="LKA">Sri Lanka</option>
										<option value="SDN">Sudan</option>
										<option value="SUR">Suriname</option>
										<option value="SJM">Svalbard and Jan Mayen</option>
										<option value="SWZ">Swaziland</option>
										<option value="SWE">Sweden</option>
										<option value="CHE">Switzerland</option>
										<option value="SYR">Syrian Arab Republic</option>
										<option value="TWN">Taiwan, Province of China</option>
										<option value="TJK">Tajikistan</option>
										<option value="TZA">Tanzania, United Republic of</option>
										<option value="THA">Thailand</option>
										<option value="TLS">Timor-Leste</option>
										<option value="TGO">Togo</option>
										<option value="TKL">Tokelau</option>
										<option value="TON">Tonga</option>
										<option value="TTO">Trinidad and Tobago</option>
										<option value="TUN">Tunisia</option>
										<option value="TUR">Turkey</option>
										<option value="TKM">Turkmenistan</option>
										<option value="TCA">Turks and Caicos Islands</option>
										<option value="TUV">Tuvalu</option>
										<option value="UGA">Uganda</option>
										<option value="UKR">Ukraine</option>
										<option value="ARE">United Arab Emirates</option>
										<option value="GBR">United Kingdom</option>
										<option value="USA">United States</option>
										<option value="UMI">United States Minor Outlying Islands</option>
										<option value="URY">Uruguay</option>
										<option value="UZB">Uzbekistan</option>
										<option value="VUT">Vanuatu</option>
										<option value="VEN">Venezuela, Bolivarian Republic of</option>
										<option value="VNM">Viet Nam</option>
										<option value="VGB">Virgin Islands, British</option>
										<option value="VIR">Virgin Islands, U.S.</option>
										<option value="WLF">Wallis and Futuna</option>
										<option value="ESH">Western Sahara</option>
										<option value="YEM">Yemen</option>
										<option value="ZMB">Zambia</option>
										<option value="ZWE">Zimbabwe</option>
									</select>
								</div>
							</div>	

							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_pass_num" class="col-form-label">Pasaporte No.:</label>
									<input type="text" id="xsubcontact_pass_num" name="xsubcontact_pass_num" class="form-control">
								</div>
								<div class="col">
									<label for="xsubcontact_pass_exp" class="col-form-label">Pasaporte Fecha Expiración:</label>
									<input type="text" id="xsubcontact_pass_exp" name="xsubcontact_pass_exp" class="form-control datepicker">
								</div>								
							</div>	
							
							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_dni" class="col-form-label">DNI No.:</label>
									<input type="text" id="xsubcontact_dni" name="xsubcontact_dni" class="form-control">
								</div>
								<div class="col">
									<label for="xsubcontact_dni_exp" class="col-form-label">DNI Fecha Expiración:</label>
									<input type="text" id="xsubcontact_dni_exp" name="xsubcontact_dni_exp" class="form-control datepicker">
								</div>								
							</div>	
							
							<div class="form-group row mt-3">
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="xsubcontact_newsletter1" value="1" name="xsubcontact_newsletter1">
										<label class="form-check-label" for="xsubcontact_newsletter1">Newsletter TRA</label>
									</div>
								</div>
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="xsubcontact_newsletter2" value="1" name="xsubcontact_newsletter2">
										<label class="form-check-label" for="xsubcontact_newsletter2">Newsletter CUC</label>
									</div>
								</div>
							</div>
							
							<div class="form-row">								
								<div class="col">
									<label for="xsubcontact_notes" class="col-form-label">Notas:</label>
									<textarea class="form-control" id="xsubcontact_notes" name="xsubcontact_notes" rows="3"></textarea>
								</div>
							</div>	
							
							<div class="modal-footer">	
								<input type="hidden" id="xsubcontact_id" name="xsubcontact_id" value="">
								<input type="hidden" id="contact_id4" name="contact_id4" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="editsubcontact" name="editsubcontact" value="save">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>		

						</div>	
							
					</form>						

				</div>
				
			</div>
			
		</div>

		<!-- Edit GES -->
		
		<div class="modal fade" id="edit_ges" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Acceso</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_ges" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="contact_ges_website">Website :</label>
									<input type="text" id="contact_ges_website" name="contact_ges_website" class="form-control" value="">
								</div>
							</div>	
							<div class="form-row">								
								<div class="col">
									<label for="contact_ges_user">Usuario :</label>
									<input type="text" id="contact_ges_user" name="contact_ges_user" class="form-control" value="">
								</div>
							</div>	
							<div class="form-row">								
								<div class="col">
									<label for="contact_ges_code">Código de Acceso :</label>
									<input type="text" id="contact_ges_code" name="contact_ges_code" class="form-control" value="">
								</div>
							</div>								
							<div class="modal-footer">							
								<input type="hidden" id="contact_id2" name="contact_id2" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar4" name="editar4" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- Edit Notes -->
		
		<div class="modal fade" id="edit_notes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Editar Notas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_edit_notes" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<textarea class="form-control" id="contact_notes" name="contact_notes" rows="3"></textarea>
								</div>
							</div>						
							<div class="modal-footer">		
								<input type="hidden" id="contact_id3" name="contact_id3" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar5" name="editar5" value="edit">Guardar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- Create folder -->
		
		<div class="modal fade" id="create_folder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">		
			<div class="modal-dialog" role="document">			
				<div class="modal-content">				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Crear Folder Nuevo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>					
					<form id="form_create_folder" method="post" autocomplete="off">						
						<div class="modal-body">						
							<div class="form-row">								
								<div class="col">
									<label for="fold_name">Nombre de Folder :</label>
									<input type="text" id="fold_name" name="fold_name" class="form-control" value="" required>
								</div>
							</div>						
							<div class="modal-footer">		
								<input type="hidden" id="fold_contact" name="fold_contact" value="<?php echo $contact_id; ?>">
								<button type="submit" class="btn btn-primary" id="editar5" name="editar5" value="edit">Crear Folder</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>						
							</div>
						</div>								
					</form>	
				</div>				
			</div>			
		</div>
		
		<!-- jQuery, Popper.js, Bootstrap JS -->

		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
		
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

		<!-- datepicker -->
	
		<script>
			$(document).ready(function() {   
				var userLang = navigator.language || navigator.userLanguage; 		  
				var options = $.extend({}, // empty object    
					$.datepicker.regional["es"], {  
						dateFormat: "dd/mm/yy" ,
						changeMonth: true,
						changeYear: true,
						yearRange: '1910:2050',
					} // your custom options    
				);  		  
				$(".datepicker").datepicker(options);  
			}); 									
		</script>
		
		<!-- Edit General Contact Info -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit0').click(function() {
					$('#edit0').val("Editar");
					$('#form_editcontact')[0].reset();
				});
				$(document).on('click', '.edit_data0', function(){  
					var contact_id = <?php echo $contact_id; ?>;  
					$.ajax({  
						url:"fetch_ctc1.php",  
						method:"POST",  
						data:{contact_id:contact_id},  
						dataType:"json",  
						success:function(data){  
							$('#contact_name').val(data.contact_name); 
							$('#contact_lastname').val(data.contact_lastname); 
							$('#contact_alias').val(data.contact_alias); 
							$('#contact_classif0').val(data.contact_classif0);  
							$('#contact_classif1').val(data.contact_classif1);  
							$('#contact_classif2').val(data.contact_classif2);  
							$('#contact_address1').val(data.contact_address1); 
							$('#contact_address2').val(data.contact_address2); 							
							$('#contact_city').val(data.contact_city);
							$('#contact_pc').val(data.contact_pc);
							$('#contact_country').val(data.contact_country);							
							$('#contact_phone').val(data.contact_phone);  	
							$('#contact_fax').val(data.contact_fax);  	
							$('#contact_email').val(data.contact_email);
							$('#contact_dob').val(data.contact_dob);							
							$('#contact_nationality').val(data.contact_nationality); 							
							$('#contact_dni').val(data.contact_dni); 
							$('#contact_dni_exp').val(data.contact_dni_exp); 
							$('#contact_pass_num').val(data.contact_pass_num);							
							$('#contact_pass_exp').val(data.contact_pass_exp); 
							if((data.contact_newsletter1) == '1') {
								$('#contact_newsletter1').prop('checked',true);								
							}else{
								$('#contact_newsletter1').prop('checked',false);								
							}
							if((data.contact_newsletter2) == '1') {
								$('#contact_newsletter2').prop('checked',true);								
							}else{
								$('#contact_newsletter2').prop('checked',false);								
							}						
							$('#editcontact').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send form_editcontact Info -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_editcontact']").submit(function(){
				$.ajax({
					url : 'dir_contacts_general_info_ed.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#general_info").html(data);
						$('#editcontact').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>	

		<!-- Edit Subcontact -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit_x').click(function() {
					$('#edit_x').val("Editar");
					$('#form_editsubcontact')[0].reset();
				});
				$(document).on('click', '.edit_data_sub', function(){  
					var contact_id = $(this).attr("subid");  
					$.ajax({  
						url:"fetch_ctc2.php",  
						method:"POST",  
						data:{contact_id:contact_id},  
						dataType:"json",  
						success:function(data){ 
							$('#xsubcontact_id').val(data.subcontact_id); 
							$('#xsubcontact_name').val(data.subcontact_name); 
							$('#xsubcontact_lastname').val(data.subcontact_lastname); 
							$('#xsubcontact_alias').val(data.subcontact_alias);
							$('#xsubcontact_phone').val(data.subcontact_phone);  	
							$('#xsubcontact_email').val(data.subcontact_email);							
							$('#xsubcontact_dob').val(data.subcontact_dob); 
							$('#xsubcontact_nationality').val(data.subcontact_nationality); 
							$('#xsubcontact_dni').val(data.subcontact_dni); 
							$('#xsubcontact_dni_exp').val(data.subcontact_dni_exp); 
							$('#xsubcontact_pass_num').val(data.subcontact_pass_num);							
							$('#xsubcontact_pass_exp').val(data.subcontact_pass_exp); 
							$('#xsubcontact_notes').val(data.subcontact_notes); 
							if((data.subcontact_newsletter1) == '1') {
								$('#xsubcontact_newsletter1').prop('checked',true);								
							}else{
								$('#xsubcontact_newsletter1').prop('checked',false);								
							}
							if((data.subcontact_newsletter2) == '1') {
								$('#xsubcontact_newsletter2').prop('checked',true);								
							}else{
								$('#xsubcontact_newsletter2').prop('checked',false);								
							}	
							$('#edit_subcontact').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>

		<!-- Send form_editsubcontact form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_editsubcontact']").submit(function(){
				$.ajax({
					url : 'dir_subcontacts_info_ed.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#other_info").html(data);
						$('#edit_subcontact').modal('hide');  
					}
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>

		<!-- Edit GES -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit1').click(function() {
					$('#edit1').val("Editar");
					$('#form_edit_ges')[0].reset();
				});
				$(document).on('click', '.edit_data1', function(){  
					var contact_id = <?php echo $contact_id; ?>;  
					$.ajax({  
						url:"fetch_ctc1.php",  
						method:"POST",  
						data:{contact_id:contact_id},  
						dataType:"json",  
						success:function(data){  
							$('#contact_ges_website').val(data.contact_ges_website);  
							$('#contact_ges_user').val(data.contact_ges_user);  
							$('#contact_ges_code').val(data.contact_ges_code);  
							$('#edit_ges').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send form_edit_ges form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_ges']").submit(function(){
				$.ajax({
					url : 'dir_contacts_ges_info_ed.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#other_info").html(data);
						$('#edit_ges').modal('hide');  
					}
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>
		
		<!-- Edit Notes -->
		
		<script>		
			$(document).ready(function(){  
				$('#edit_nt').click(function() {
					$('#edit_nt').val("Editar");
					$('#form_edit_notes')[0].reset();
				});
				$(document).on('click', '.edit_notes', function(){  
					var contact_id = <?php echo $contact_id; ?>;  
					$.ajax({  
						url:"fetch_ctc1.php",  
						method:"POST",  
						data:{contact_id:contact_id},  
						dataType:"json",  
						success:function(data){  
							$('#contact_notes').val(data.contact_notes);  
							$('#edit_notes').modal('show');  
						}  
					});  
				});  	 
			});  
		</script>
		
		<!-- Send form_edit_notes form -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_edit_notes']").submit(function(){
				$.ajax({
					url : 'dir_contacts_notes_ed.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#card_notes").html(data);
						$('#edit_notes').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>		
		
		<!-- Send form_create_folder Info -->
		
		<script>
			$(document).ready(function(){
			  $("form[id='form_create_folder']").submit(function(){
				$.ajax({
					url : 'dir_contacts_create_folder.php',
					type : 'POST',
					data : $(this).serialize(),
					success : function(data){
						$("#cloud_docs").html(data);
						$('#create_folder').modal('hide');  
				   }
				});
				//!This is important to stay the page without reload
				return false;
			  });
			});		
		</script>		

	</body>
	
</html>