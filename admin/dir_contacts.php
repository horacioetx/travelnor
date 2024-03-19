<?php

	//include config
	
	require_once('includes/config.php');
	
	// if not logged in redirect to login page
	
	if(!$user->is_logged_in()){ header('Location: login.php'); }
	
	//define page title
	
	$title = "Directorio de Contactos";
	
	/* save new contact */

	if($_POST['addcontact'] == "save") {
		
		$stmt = $db->prepare('INSERT INTO dir_contacts (contact_name, contact_lastname, contact_alias, contact_classif0, contact_classif1, contact_classif2, contact_address1, contact_address2, contact_city, contact_pc, contact_country, contact_phone, contact_fax, contact_email, contact_dob, contact_nationality, contact_dni, contact_dni_exp, contact_pass_num, contact_pass_exp, contact_newsletter1, contact_newsletter2) VALUES (:contact_name, :contact_lastname, :contact_alias, :contact_classif0, :contact_classif1, :contact_classif2, :contact_address1, :contact_address2, :contact_city, :contact_pc, :contact_country, :contact_phone, :contact_fax, :contact_email, :contact_dob, :contact_nationality, :contact_dni, :contact_dni_exp, :contact_pass_num, :contact_pass_exp, :contact_newsletter1, :contact_newsletter2)');
		
		$stmt->bindParam(':contact_name', $_POST['contact_name']);
		$stmt->bindParam(':contact_lastname', $_POST['contact_lastname']);
		$stmt->bindParam(':contact_alias', $_POST['contact_alias']);
		$stmt->bindParam(':contact_classif0', $_POST['contact_classif0']);
		$stmt->bindParam(':contact_classif1', $_POST['contact_classif1']);
		$stmt->bindParam(':contact_classif2', $_POST['contact_classif2']);
		$stmt->bindParam(':contact_address1', $_POST['contact_address1']);
		$stmt->bindParam(':contact_address2', $_POST['contact_address2']);
		$stmt->bindParam(':contact_city', $_POST['contact_city']);	
		$stmt->bindParam(':contact_pc', $_POST['contact_pc']);	
		$stmt->bindParam(':contact_country', $_POST['contact_country']);			
		$stmt->bindParam(':contact_phone', $_POST['contact_phone']);
		$stmt->bindParam(':contact_fax', $_POST['contact_fax']);
		$stmt->bindParam(':contact_email', $_POST['contact_email']);		
		$stmt->bindParam(':contact_dob', $_POST['contact_dob']);
		$stmt->bindParam(':contact_nationality', $_POST['contact_nationality']);		
		$stmt->bindParam(':contact_dni', $_POST['contact_dni']);
		$stmt->bindParam(':contact_dni_exp', $_POST['contact_dni_exp']);
		$stmt->bindParam(':contact_pass_num', $_POST['contact_pass_num']);
		$stmt->bindParam(':contact_pass_exp', $_POST['contact_pass_exp']);		
		$stmt->bindParam(':contact_newsletter1', $_POST['contact_newsletter1']);
		$stmt->bindParam(':contact_newsletter2', $_POST['contact_newsletter2']);		
	
		$stmt->execute();							

		header("Location: dir_contacts?okmsg=Contacto Agregado!");		
		
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
		
		<!-- Bootstrap and misc vendor CSS -->
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/379421e620.js" crossorigin="anonymous"></script>

		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,400i|Playfair+Display&display=swap" rel="stylesheet">		

		<!-- custom CSS -->
		
		<link href="css/styles.css" rel="stylesheet">
		
		<!-- title -->

		<title><?php echo $title; ?></title>
		
		<style>
			.fields_cli{
			   display:block;
			}		
		</style>
		
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
							<li class="breadcrumb-item active" aria-current="page">Directorio de Contactos</li>
						</ol>
					</nav>							
				</div>
	
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newcontact">Agregar Contacto</button>

				<?php
				
					$stmt = $db->prepare('SELECT contact_id, contact_name, contact_lastname, contact_alias, contact_email, contact_classif0, contact_classif1, contact_classif2 FROM dir_contacts ORDER BY contact_name');
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
							
							$disp_name = $rrows['contact_name'] . " " . $rrows['contact_lastname'];
							
							if ($rrows['contact_alias'] <> "")
								$disp_name .= " (" . $rrows['contact_alias'] . ')';
							
							$disp_class = $rrows['contact_classif0'];
							
							if ($rrows['contact_classif1'] <> "")
								$disp_class .= " / " . $rrows['contact_classif1'];
							
							/* links to edit and delete */
							
							$view = '<td style="text-align: center;"><form method="post" action="dir_contacts_view"><input type="submit" name="ctcview" value="Ver" class="btn btn-success btn-sm delete_data"><input type="hidden" name="contact_id" value="' . $rrows['contact_id'] . '"></form></td>';
							
							$output .= '<tr>';
								$output .= '<td>' . $disp_name . '</td><td style="text-align: left;"><a href="mailto:' . $rrows['contact_email']  . '" style="color:#0056b3;">' . $rrows['contact_email'] . '</a></td><td style="text-align: center;">' . $rrows['contact_classif2'] . '</td><td style="text-align: center;">' . $disp_class . '</td>' . $view;
							$output .= '</tr>';
							
							
							/* search for subcontacts to merge in listing display */
							
							$stmt_sc = $db->prepare('SELECT subcontact_contact, subcontact_name, subcontact_lastname, subcontact_alias, subcontact_email FROM dir_subcontacts WHERE subcontact_contact = :subcontact_contact ORDER BY subcontact_name');
							$stmt_sc->bindParam(':subcontact_contact', $rrows['contact_id']);								
							$stmt_sc->execute();
							
							while ($rows_sc = $stmt_sc->fetch(PDO::FETCH_ASSOC)) {	
							
								$disp_subname = $rows_sc['subcontact_name'] . " " . $rows_sc['subcontact_lastname'];
								
								if ($rows_sc['subcontact_alias'] <> "")
									$disp_subname .= " (" . $rows_sc['subcontact_alias'] . ')';
							
								$output .= '<tr>';
									$output .= '<td style="color:#d9d9d9;">' . $disp_subname . '</td><td style="text-align: left;"><a href="mailto:' . $rows_sc['subcontact_email'] . '" style="color:#0056b3;">' . $rows_sc['subcontact_email'] . '</a></td><td style="text-align: center; color:#d9d9d9;">' . $rrows['contact_classif2'] . '</td><td style="text-align: center; color:#d9d9d9;">' . $disp_class . '</td>' . $view;
								$output .= '</tr>';
							
							}								

						}
						
						echo '<p class="text-right mr-3">No. Items : ' . $cont1 . '</p>';
						
						echo '<table id="table_list" class="table table-bordered table-hover">';							
							echo '<thead class="thead-dark">';
								echo '<tr><th scope="col">Contacto</th><th scope="col" style="text-align: center;">Email</th><th scope="col" style="text-align: center;">Categoría</th><th scope="col" style="text-align: center;">Marca</th><th scope="col" style="text-align: center;">Ver</th></tr>';
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
		
		<div class="modal fade" id="newcontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		
			<div class="modal-dialog modal-lg" role="document">
			
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar Contacto</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					
					<form id="form_addcontact" method="post">	
					
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
										<input class="form-check-input" type="checkbox" id="contact_newsletter1" value="1" name="contact_newsletter1">
										<label class="form-check-label" for="contact_newsletter1">Newsletter TRA</label>
									</div>
								</div>
								<div class="col">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="contact_newsletter2" value="1" name="contact_newsletter2">
										<label class="form-check-label" for="contact_newsletter2">Newsletter CUC</label>
									</div>
								</div>
							</div>							

							<div class="modal-footer">							
								<button type="submit" class="btn btn-primary" id="addcontact" name="addcontact" value="save">Guardar</button>
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
		
		<!-- datatables -->		
		
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>		

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
		
		<script>
			$('#contact_classif2').on('change',function(){				
				var classif = document.getElementById("contact_classif2").value;
				switch(classif) {
					case "CLI": 
						$("#fields_cli").show();
						$("#fields_pro").hide();
						$("#fields_ges").hide();
						break;
						
					case "PRO":
						$("#fields_cli").hide();
						$("#fields_pro").show();
						$("#fields_ges").hide();
						break;

					case "GES":
						$("#fields_cli").hide();
						$("#fields_pro").hide();
						$("#fields_ges").show();
						break;
						
					default:
						break;
				}				
			});			
		</script>		

	</body>
	
</html>