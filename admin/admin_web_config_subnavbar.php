<?php

	/* admin_web_config_subnavbar */
	
?>

<div class="w-100 align-items-left pb-2 mb-1">
	<a href="admin_web_config" style="color:inherit;"><button type="button" class="btn btn-sm btn-info mr-2 mt-2 text-white <?php if ($active_page == "C1") echo ' active'; ?>">Configuración Inicial</button></a>
	<a href="admin_web_tickers" style="color:inherit;"><button type="button" class="btn btn-sm btn-info mr-2 mt-2 text-white <?php if ($active_page == "C2") echo ' active'; ?>">Notificaciones/Avisos</button></a>
	<a href="admin_web_legal" style="color:inherit;"><button type="button" class="btn btn-sm btn-info mr-2 mt-2 text-white <?php if ($active_page == "C3") echo ' active'; ?>">Información Legal</button></a>
</div>