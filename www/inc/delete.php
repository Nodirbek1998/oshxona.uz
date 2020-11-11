<?php
    session_start();
    include_once ('functions.php');

    if (!isset($_SESSION['user'])){
        die();
    }
    if (isset($_GET['id']) && is_numeric($_GET['id'])){
        $id = $_GET['id'];
        $sorov = 'delete from maqolalar where id_maqola ='.$id;
        $result = queryMysql($sorov);
        if ($result){
            echo "Maqola o`chirildi id_maqola=".$id."<br>";
            echo "<a href='list.php'>Maqolalar ro`yhatiga o`tish</a>";
        }
    }
?>