<?php

	// logo buttons called from ws_general_settings.php 
	
?>

<div class="col">	
						
	<h6 class="br-section-label">Large logo </h6>
	<div class="card card-body">	
		<div class="center-block tx-center">
			<span id="uploaded_image"><img src="images/logos/<?php echo $imglglg; ?>" alt="Large Logo: max 230 x 72"></span>
		</div>
	</div>		

	<br />	

	<?php if (file_exists("images/logos/" . $imglglg)) { ?>	
						
		<div class="input-group">
			<button class="btn btn-warning delbtn" id="lolg" >Delete Image</button>		
			<span class="deleting_image"><span>
		</div>	

	<?php } else { ?> 								

		<div class="input-group">
			<label class="input-group-btn">
				<span class="btn btn-primary">
					Select and Upload&hellip; <input type="file" name="file" id="file" style="display: none;">
				</span>
			</label>
		</div>									

	<?php } ?> 

</div>

<div class="col">

	<h6 class="br-section-label">Small Logo </h6>
	<div class="card card-body">											
		<div class="center-block tx-center">
			<span id="uploaded_image2"><img src="images/logos/<?php echo $imglgsm; ?>" alt="Small Logo: max 230 x 60"></span>
		</div>
	</div>	

	<br />

	<?php if (file_exists("images/logos/" . $imglgsm)) { ?>	

		<div class="input-group">
			<button class="btn btn-warning delbtn" id="losm">Delete Image</button>	
			<span class="deleting_image"><span>
		</div>	
		
	<?php } else { ?> 	

		<div class="input-group">
			<label class="input-group-btn">
				<span class="btn btn-primary">
					Select and Upload&hellip; <input type="file" name="file2" id="file2" style="display: none;">
				</span>
			</label>
		</div>

	<?php } ?> 

</div>