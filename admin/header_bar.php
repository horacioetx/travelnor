<?php

	/* header bar */	
	
	/* declare vars for header_bar */
	
	if (isset($conrow['company_website']))
		$company = $conrow['company_website'];
	else
		$company = "Empty";
		
	if (isset($_SESSION['member_fullname']))
		$fullname = $_SESSION['member_fullname'];
	else
		$fullname = "Empty";		

?>

<header class="dash-toolbar">

	<a href="#!" class="menu-toggle">
		<i class="fas fa-bars"></i>
	</a>
	
	<a href="#!" class="searchbox-toggle">
		<i class="fas fa-search"></i>
	</a>
	
	<form class="searchbox" action="#!">
		<a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
		<button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
		<input type="text" class="searchbox-input" placeholder="Buscar...">
	</form>
	
	<div class="tools">
	
		<a href="https://<?php echo $company; ?>" target="_blank" class="mr-2 d-none d-md-block my-auto"><?php echo $company; ?></a>
		
		<a href="#!" class="tools-item">
			<i class="fas fa-bell"></i>
			<!-- <i class="tools-item-count">4</i>
			<i class="tools-item-count"></i> -->
		</a>
		
		<div class="dropdown tools-item">
		
			<a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user"></i>
			</a>
			
			<div class="dropdown-menu dropdown-menu-lg-right p-0 shadow" aria-labelledby="dropdownMenu1" style="border-radius:10px;">			
			
				<div class="card-flex text-center" style="width:400px;" aria-labelledby="dropdownMenu1">
				
					<?php 					
						if (isset($_SESSION['avatar'])){					
							echo '<img src="images/' . $_SESSION['avatar'] . '" class="card-img-top mt-5" alt="' . $_SESSION['member_fullname'] . '">';
						} else {
							echo '<i class="fas fa-user-alt mt-5 text-success" style="font-size:3em;"></i>';							
						}						
					?>					
					
					<div class="card-body">
						<h6><strong><?php echo $fullname; ?></strong></h6>	
						<hr>						
						<ul class="list-group">
							<li class="list-group-item border-0"><a href="user_profile"><i class="fas fa-user-cog mr-2"></i> Profile</a></li>
							<li class="list-group-item border-0"><a href="login?logout=1"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a></li>  
						</ul>
					</div>
					
				</div>

			</div>
			
		</div>
		
	</div>
	
</header>