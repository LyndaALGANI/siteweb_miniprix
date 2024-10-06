<?php

/**
 * start session if not exit
 */
function init_session(){
    session_start();
}

function delete_session() {
    session_start();
    session_destroy();
    

header("Location: ../index.php");
}

?>