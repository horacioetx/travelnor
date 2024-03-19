<?php

    /* display to do list */

    $stmt = $db->prepare('SELECT * FROM todo WHERE user_id = :user_id');
    $stmt->bindParam(':user_id', $_SESSION['user']);
    $stmt->execute();	
    
    $numitems = $stmt->rowCount();
    
    if ($numitems == 0) {

        $output .= '<li class="list-group-item"><i class="fas fa-thumbs-up fa-lg mr-3 text-success"></i><strong>No hay tareas pendientes!</strong></li>';

    } else {

        $output = "";
        
        while ($rrows = $stmt->fetch(PDO::FETCH_ASSOC)) {	

            /* check status if task is completed */

            if ($rrows['task_status'] == 0)
                $disp_task = $rrows['task'];
            else
                $disp_task = '<span class="text-secondary"><s>' . $rrows['task'] . '</s></span>';

            /* determine priority color */

            if ($rrows['priority'] == 0)
                $priority = '<i class="fas fa-bookmark text-success mr-3"></i>';
            if ($rrows['priority'] == 1)
                $priority = '<i class="fas fa-bookmark text-warning mr-3"></i>';
            if ($rrows['priority'] == 2)
                $priority = '<i class="fas fa-bookmark text-danger mr-3"></i>';

            /* set delete button */

            $del = '<a data-org="tasks-del" data-row-id="' . $rrows['task_id'] . '" href="javascript:void(0)" class="text-danger delete_item float-right mr-3" title="Eliminar Tarea" data-toggle="tooltip"><i class="fas fa-trash-alt"></i></a>';
            $task = '<a data-org="tasks-done" data-row-id="' . $rrows['task_id'] . '" href="javascript:void(0)" class="text-dark task-done">' . $disp_task . '</a>';
  
            $output .= '<li class="list-group-item">' . $priority . $task . $del . '</li>';

        }             

    }

    echo '<ul class="list-group">';
        echo '<li class="list-group-item bg-warning text-white"><strong><i class="fas fa-clipboard-list mr-3"></i>Tareas por hacer</strong></li>';
        echo $output;
    echo '</ul>';   

    echo '<div class="container-fluid border-top border-bottom py-3 mb-4 pr-0 text-right">';
        echo '<button type="button" class="btn btn-success btn-sm mr-0" data-toggle="modal" data-target="#new">Agregar Tarea</button>';	
    echo '</div>';

?>




