<?php

	/* full top navbar */
	
	$company = $conr['company_name'];
	
	/* get main config info */
	
	$stmt_conf = $db->prepare('SELECT company_name, company_logo_sys FROM config');	
	$stmt_conf->execute();
	$row_conf = $stmt_conf->fetch(PDO::FETCH_ASSOC);	

?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark" style="background-color:#002554 !important;">

	<a class="navbar-brand" href="home"><img src="images/logos/<?php echo $row_conf['company_logo_sys']; ?>" style="width:150px;"></a>
	
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<div class="collapse navbar-collapse ml-4 pl-5" id="navbarSupportedContent">
	
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a href="#" data-toggle="sidebar-colapse" class="bg-blue list-group-item list-group-item-action d-flex align-items-center"><i class="text-light fa fa-navicon fa-lg py-2 p-1"></i></a>
			</li>
		</ul>
		
		<form class="form-inline my-2 my-lg-0">
			<span class="text-white mr-2"><?php echo $_SESSION['member_name']; ?></span>
		  <a class="nav-link text-white" href="logout">Salir</a>
		</form>
		
	</div>
	
</nav>


