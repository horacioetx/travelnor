<?php

	/* navbar */	
	
	/* declare vars for navbar */
	
	if (isset($conrow['dash_bg_color']))
		$bgcolour = $conrow['dash_bg_color'];
	else
		$bgcolour = "76a4d5";

?>

<div class="dash-nav dash-nav-dark" style="background-color:#<?php echo $bgcolour; ?>;">

	<header>
		<a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
		
		<?php
		
			/* check if logo image exists and display it */
			
			if (isset($conrow['dash_logo']) and ($conrow['dash_logo'] <> ""))
				echo '<a href="home"><img src="images/logos/' . $conrow['dash_logo'] . '" style="width:140px; height:auto;"> </a>';
			else
				echo '<a href="home"><i class="fab fa-earlybirds fa-3x"></i></a>';		
		
		?>
		
	</header>
	
	<nav class="dash-nav-list">

		<a href="home" class="dash-nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'home.php') echo ' font-weight-bold'; ?>"><i class="fas fa-home"></i> Dashboard </a>

		<a href="email" class="dash-nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'email.php') echo ' font-weight-bold'; ?>"><i class="fas fa-envelope"></i> Email </a>
		
		<div class="dash-nav-dropdown <?php if ((basename($_SERVER['PHP_SELF']) == 'dir_users.php') or (basename($_SERVER['PHP_SELF']) == 'dir_contacts.php') or (basename($_SERVER['PHP_SELF']) == 'dir_contacts_view.php')) echo ' show'; ?>">
			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle"><i class="fas fa-id-card"></i> Directorios </a>			
			<div class="dash-nav-dropdown-menu">
				<a href="dir_users" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'dir_users.php') echo ' text-warning'; ?>">Usuarios</a>
				<a href="dir_contacts" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'dir_contacts.php' or basename($_SERVER['PHP_SELF']) == 'dir_contacts_view.php') echo ' text-warning'; ?>">Contactos</a>
			</div>			
		</div>

		<a href="files" class="dash-nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'files.php') echo ' font-weight-bold'; ?>"><i class="fas fa-laptop"></i> CRM </a>

		<div class="dash-nav-dropdown 

			<?php if ((basename($_SERVER['PHP_SELF']) == 'admin_web_config.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_ribbons.php') or (basename($_SERVER['PHP_SELF']) == 'admin_web_tickers.php') or (basename($_SERVER['PHP_SELF']) == 'admin_web_legal.php') 
					or (basename($_SERVER['PHP_SELF']) == 'admin_program_categories.php') or (basename($_SERVER['PHP_SELF']) == 'admin_programs.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_view.php')
					or (basename($_SERVER['PHP_SELF']) == 'admin_itinerary.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_hotels.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_rates.php')
					or (basename($_SERVER['PHP_SELF']) == 'admin_program_includes.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_extensions.php') or (basename($_SERVER['PHP_SELF']) == 'admin_program_extrainfo.php')
					or (basename($_SERVER['PHP_SELF']) == 'admin_generic_txt.php') or (basename($_SERVER['PHP_SELF']) == 'home_settings.php') or (basename($_SERVER['PHP_SELF']) == 'dir_pages.php') or (basename($_SERVER['PHP_SELF']) == 'dir_pages_view.php')
					or (basename($_SERVER['PHP_SELF']) == 'foot_settings.php')) echo ' show'; ?>">		

			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle"><i class="fas fa-laptop-code"></i> Website CMS </a>		

			<div class="dash-nav-dropdown-menu">
				<a href="admin_web_config" class="dash-nav-dropdown-item <?php if($active_page == 'C1' or $active_page == 'C2' or $active_page == 'C3') echo ' text-warning'; ?>">Website Configuración</a>
				<a href="admin_program_categories" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'admin_program_categories.php') echo ' text-warning'; ?>">Directorio de Categorías</a>
				<a href="admin_program_ribbons" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'admin_program_ribbons.php') echo ' text-warning'; ?>">Directorio de Sellos</a>
				<a href="admin_programs" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'admin_programs.php' or $active_page == "1" or $active_page == "2" or $active_page == "3" or $active_page == "4" or $active_page == "5" or $active_page == "6" or $active_page == "7") echo ' text-warning'; ?>">Directorio de Viajes</a>
				<a href="admin_generic_txt" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'admin_generic_txt.php') echo ' text-warning'; ?>">Textos Genéricos</a>
				<div class="dash-nav-dropdown-item my-2 text-white"><strong>PAGINAS FIJAS</strong></div>
				<a href="home_settings" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'home_settings.php') echo ' text-warning'; ?>">Home (Inicio)</a>
				<a href="dir_pages" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'dir_pages.php' or $active_page == "p1") echo ' text-warning'; ?>">Páginas</a>
				<a href="foot_settings" class="dash-nav-dropdown-item <?php if(basename($_SERVER['PHP_SELF']) == 'foot_settings.php') echo ' text-warning'; ?>">Pie de Página</a>
			</div>	
			
		</div>
			
		<a href="blog" class="dash-nav-item <?php if ((basename($_SERVER['PHP_SELF']) == 'blog.php') or (basename($_SERVER['PHP_SELF']) == 'blog_view.php')) echo ' font-weight-bold'; ?>"><i class="fab fa-blogger-b"></i> Blog </a>
			
		<!--
		
		<div class="dash-nav-dropdown">
			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
				<i class="fas fa-chart-bar"></i> Charts </a>
			<div class="dash-nav-dropdown-menu">
				<a href="chartjs.html" class="dash-nav-dropdown-item">Chart.js</a>
			</div>
		</div>		
		
		<div class="dash-nav-dropdown ">
			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
				<i class="fas fa-cube"></i> Components </a>
			<div class="dash-nav-dropdown-menu">
				<a href="cards.html" class="dash-nav-dropdown-item">Cards</a>
				<a href="forms.html" class="dash-nav-dropdown-item">Forms</a>
				<div class="dash-nav-dropdown ">
					<a href="#" class="dash-nav-dropdown-item dash-nav-dropdown-toggle">Icons</a>
					<div class="dash-nav-dropdown-menu">
						<a href="icons.html" class="dash-nav-dropdown-item">Solid Icons</a>
						<a href="icons.html#regular-icons" class="dash-nav-dropdown-item">Regular Icons</a>
						<a href="icons.html#brand-icons" class="dash-nav-dropdown-item">Brand Icons</a>
					</div>
				</div>
				<a href="stats.html" class="dash-nav-dropdown-item">Stats</a>
				<a href="tables.html" class="dash-nav-dropdown-item">Tables</a>
				<a href="typography.html" class="dash-nav-dropdown-item">Typography</a>
				<a href="userinterface.html" class="dash-nav-dropdown-item">User Interface</a>
			</div>
		</div>
		<div class="dash-nav-dropdown">
			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
				<i class="fas fa-file"></i> Layouts </a>
			<div class="dash-nav-dropdown-menu">
				<a href="blank.html" class="dash-nav-dropdown-item">Blank</a>
				<a href="content.html" class="dash-nav-dropdown-item">Content</a>
				<a href="login.html" class="dash-nav-dropdown-item">Log in</a>
				<a href="signup.html" class="dash-nav-dropdown-item">Sign up</a>
			</div>
		</div>
		<div class="dash-nav-dropdown">
			<a href="#!" class="dash-nav-item dash-nav-dropdown-toggle">
				<i class="fas fa-info"></i> About </a>
			<div class="dash-nav-dropdown-menu">
				<a href="https://github.com/subet/easion" target="_blank" class="dash-nav-dropdown-item">GitHub</a>
				<a href="https://usebootstrap.com/theme/easion" target="_blank" class="dash-nav-dropdown-item">UseBootstrap</a>
				<a href="https://mudimedia.com" target="_blank" class="dash-nav-dropdown-item">Mudimedia Software</a>
			</div>
		</div>

-->

	</nav>
	
</div>