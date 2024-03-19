<?php

	/* programs_subnav */
	
?>

<div class="w-100 align-items-left pb-2 mb-1">
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "1") echo ' active'; ?>"><a href="admin_program_view?progid=<?php echo $prog_id;?>" style="color:inherit;">General</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "2") echo ' active'; ?>"><a href="admin_itinerary?progid=<?php echo $prog_id;?>" style="color:inherit;">Itinerario</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "3") echo ' active'; ?>"><a href="admin_program_hotels?progid=<?php echo $prog_id;?>" style="color:inherit;">Hoteles</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "4") echo ' active'; ?>"><a href="admin_program_rates?progid=<?php echo $prog_id;?>" style="color:inherit;">Tarifas</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "5") echo ' active'; ?>"><a href="admin_program_includes?progid=<?php echo $prog_id;?>" style="color:inherit;">Inclusiones</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "6") echo ' active'; ?>"><a href="admin_program_extensions?progid=<?php echo $prog_id;?>" style="color:inherit;">Extensiones</a></button>
	<button type="button" class="btn btn-info mr-2 mt-2 text-white <?php if ($active_page == "7") echo ' active'; ?>"><a href="admin_program_extrainfo?progid=<?php echo $prog_id;?>" style="color:inherit;">Extra Info</a></button>
</div>