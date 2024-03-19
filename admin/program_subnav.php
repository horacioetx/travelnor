<?php

	/* programs_subnav */
	
?>

<div class="w-100 align-items-left pb-2 mb-1">

	<a href="admin_program_view?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "1") echo ' active'; ?>">General</button></a>
	<a href="admin_itinerary?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "2") echo ' active'; ?>">Itinerario</button></a>
	<a href="admin_program_hotels?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "3") echo ' active'; ?>">Hoteles</button></a>
	<a href="admin_program_rates?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "4") echo ' active'; ?>">Tarifas</button></a>
	<a href="admin_program_includes?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "5") echo ' active'; ?>">Inclusiones</button></a>
	<a href="admin_program_extensions?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "6") echo ' active'; ?>">Extensiones</button></a>
	<a href="admin_program_extrainfo?progid=<?php echo $prog_id;?>" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white <?php if ($active_page == "7") echo ' active'; ?>">Extra Info</button></a>

	<a href="https://<?php echo $conrow['company_website'] . '/programs?program=' . $prog_id; ?>" target="_blank" style="color:inherit;"><button type="button" class="btn btn-info btn-sm mr-2 mt-2 text-white float-right"><i class="fas fa-search mr-2"></i>Vista Previa</button></a>
	
</div>