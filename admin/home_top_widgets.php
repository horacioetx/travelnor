<?php

    /* home_top_widgets */

?>

<div class="row mt-5">
    <div class="col-md-3">
        <div class="stats stats-primary ">
            <h3 class="stats-title"> Contactos </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fa-address-card"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number"><?php echo $num_contacts; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats stats-success ">
            <h3 class="stats-title"> Sub Contactos </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fa-id-badge"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number"><?php echo $num_subcontacts; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats stats-warning ">
            <h3 class="stats-title"> Total Programas </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fa-luggage-cart"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number"><?php echo $num_programs; ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats stats-danger ">
            <h3 class="stats-title"> Programas Activos </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number"><?php echo $num_act_programs; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
    
