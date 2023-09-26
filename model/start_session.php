<?php
function start_my_session(){
        session_name("hpcportal");
        session_cache_expire(60); //minutes
        session_start();
        session_regenerate_id();    // regenerated the session, delete the old one.
        $inactive = 3600;
        if(isset($_SESSION['start']) ) {
                $session_life = time() - $_SESSION['start'];
                        if($session_life > $inactive){
                        session_destroy();
                        header("Location: index.php");
                        }
        }
        $_SESSION['start'] = time();
}

?>

