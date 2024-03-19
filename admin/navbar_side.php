<?php

	/* Full side navbar */

?>

<div id="sidebar-container" class="sidebar-expanded d-none d-md-block" style="background-color:#002554;">

	<ul class="nav nav-sidebar">
		
		<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
			<small>MENU PRINCIPAL</small>
		</li>		
		
		<a href="home" class="bg-blue list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fa fa-dashboard fa-fw mr-3"></span> 
				<span class="menu-collapsed">Dashboard</span>
			</div>
		</a>
		<a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-blue list-group-item list-group-item-action flex-column align-items-start">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fa fa-user fa-fw mr-3"></span>
				<span class="menu-collapsed">Directorios</span>
				<span class="submenu-icon ml-auto"></span>
			</div>
		</a>
		<div id='submenu2' class="collapse sidebar-submenu">
			<a href="dir_users" class="list-group-item list-group-item-action bg-blue text-white">
				<span class="menu-collapsed">Usuarios</span>
			</a>
			<a href="dir_contacts" class="list-group-item list-group-item-action bg-blue text-white">
				<span class="menu-collapsed">Contactos</span>
			</a>
		</div> 

		<a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-blue list-group-item list-group-item-action flex-column align-items-start">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="far fa-window-maximize mr-3"></span>
				<span class="menu-collapsed">Website CRM</span>
				<span class="submenu-icon ml-auto"></span>
			</div>
		</a>		
		<div id='submenu3' class="collapse sidebar-submenu">
			<a href="xxx" class="list-group-item list-group-item-action bg-blue text-white">
				<span class="menu-collapsed">Configuración Website</span>
			</a>
			<a href="admin_program_ribbons" class="list-group-item list-group-item-action bg-blue text-white">
				<span class="menu-collapsed">Catálogo de Sellos</span>
			</a>
			<a href="admin_programs" class="list-group-item list-group-item-action bg-blue text-white">
				<span class="menu-collapsed">Programas de Viaje</span>
			</a>			
		</div>  
		
		<a href="#" class="bg-blue list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fa fa-tasks fa-fw mr-3"></span>
				<span class="menu-collapsed">Tareas</span>    
			</div>
		</a>
		
		<li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
			<small>EXTRAS</small>
		</li>		
		
		<a href="#" class="bg-blue list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fa fa-calendar fa-fw mr-3"></span>
				<span class="menu-collapsed">Calendario</span>
			</div>
		</a>
		
		<a href="#" class="bg-blue list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fa fa-envelope-o fa-fw mr-3"></span>
				<span class="menu-collapsed">Email</span>
			</div>
		</a>

		<li class="list-group-item sidebar-separator menu-collapsed"></li>     
		
		<a href="#" class="bg-blue list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-start align-items-center">
				<span class="fas fa-cog mr-3"></span>
				<span class="menu-collapsed">ERP Configuración</span>
			</div>
		</a>
 
	</ul>
	
</div>








