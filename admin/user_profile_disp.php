<?php
    
    /* retrieve user info */

    $stmt = $db->prepare("SELECT * FROM utenti WHERE id = :id"); 
    $stmt->bindParam(':id', $_SESSION['user']);    
    $stmt->execute();	

    $rowuse = $stmt->fetch();

    /* define access level */

    if ($rowuse['level'] == 2)
        $disp_level = "Administrator";
    elseif ($rowuse['level'] == 1)
        $disp_level = "Webmaster";
    elseif ($rowuse['level'] == 0)
        $disp_level = "Collaborator";

    /* retrieve avatar */
                    
    if (isset($rowuse['avatar'])){					
        $avatar = '<img src="images/' . $rowuse['avatar'] . '" class="card-img-top mt-5" alt="' . $_SESSION['member_fullname'] . '">';
    } else {
        $avatar = '<i class="fas fa-user-alt mt-5 text-success" style="font-size:5em;"></i>';							
    }		   

?>

<div class="row">

	<div class="col-9">

        <div class="card easion-card">
                                        
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="easion-card-title"> Perfil de Usuario </div>
                <button type="button" name="edit0" id="edit0" value="Edit" class="btn btn-info btn-sm edit_data0 float-right"><i class="fas fa-pencil-alt"></i></button>
            </div>
            
            <div class="card-body">	
                <div class="row">
                    <div class="col">
                                                                    
                        <h6 class="card-title">Nombre : <span class="text-info"><?php echo $rowuse['first_name'] . " " . $rowuse['last_name']; ?></span></h6>													
                        <h6 class="card-title">Email : <span class="text-info"><?php echo $rowuse['email']; ?></span></h6>      
                        <h6 class="card-title">Nivel de Acceso : <span class="text-info"><?php echo $disp_level; ?></span></h6>  
                        <h6 class="card-title">Usuario desde : <span class="text-info"><?php echo $rowuse['user_since']; ?></span></h6>       
                        
                    </div>
                </div>
            </div>
            
        </div>

    </div>

    <div class="col-3">

		<div class="card easion-card h-100">
			<div class="card-header d-flex justify-content-between align-items-center"><strong> Avatar </strong><button class="btn btn-info btn-sm float-right mt-2" data-toggle="modal" data-target="#edit_avatar" title="Avatar"><i class="fas fa-user-alt"></i></button></div>
			<div class="card-body text-center">	

				<?php echo $avatar; ?>

			</div>					
		</div>
		
	</div>

</div>