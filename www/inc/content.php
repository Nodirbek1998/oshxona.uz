<?php
    if (isset($_GET['bolim']) && is_numeric($_GET['bolim'])){
        $bolim = $_GET['bolim'];

        if ($bolim == 55){
            include ('gallery.html');
        }elseif($bolim==0){
            include ('inc/aloqa.php');
        }else {

            $sorov = 'select * from maqolalar where `m_bolim_id`=' . $bolim;
            $result = queryMysql($sorov);
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo '<article class="bolim"> <figure>';
                echo "<a href='?maqola=" . $row['id_maqola'] . "'><img src='images/" . $row['m_rasmi'] . "' alt='" .aslString($row['m_sarlavha']). "' /></a>";
                echo "<figcaption>" .aslString($row['m_sarlavha']). "</figcaption></figure>";
                echo "<hgroup><h2><a href='?maqola=" . $row['id_maqola'] . "'>" .aslString($row['m_sarlavha']). "</a></h2></hgroup>";
                echo "<p>" .aslString($row['m_qisqa']);
                echo "<a href='?maqola=" . $row['id_maqola'] . "'>davomi...</a></p></article>";
            }
        }
    }elseif (isset($_POST['comment'])){
        include ('inc/aloqa.php');

    } elseif (isset($_GET['maqola']) && is_numeric($_GET['maqola'])){
        $maqola = $_GET['maqola'];
        $sorov = 'select * from maqolalar where `id_maqola`='.$maqola;
        $result = queryMysql($sorov);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        echo '<article class="maqola">';
        echo "<h2>".aslString($row['m_sarlavha'])."</h2>";
        echo "<p>".aslString($row['m_matni'])."</p>";
        echo "</article>";
        if (!empty($row['m_kalit_soz'])){
        kalit_sozni_chiqarish($row['m_kalit_soz']);
        }

        $oqildi = $row['m_oqildi']+1;
        $sorov = 'Update `maqolalar` set `m_oqildi`='.$oqildi.' where `maqolalar`.`id_maqola`='.$maqola;
        $result = queryMysql($sorov);

    }elseif (isset($_GET['kalit_soz'])){
        $kalit_soz = sanitizeString($_GET['kalit_soz']);
        qidirish($kalit_soz);

    }elseif ($_GET['m_kalit_soz']){
        $m_kalit_soz = sanitizeString($_GET['m_kalit_soz']);
        qidirish($m_kalit_soz);
    }
    else {
        $sorov = 'select * from maqolalar order by id_maqola desc
                    limit 0, 4';
        $result = queryMysql($sorov);
        $row = $result->fetch_array(MYSQLI_ASSOC);

        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo '<article class="bolim"> <figure>';
            echo "<a href='?maqola=".$row['id_maqola']."'><img src='images/".$row['m_rasmi']."' alt='".aslString($row['m_sarlavha'])."' /></a>";
            echo "<figcaption>".aslString($row['m_sarlavha'])."</figcaption></figure>";
            echo "<hgroup><h2><a href='?maqola=".$row['id_maqola']."'>".aslString($row['m_sarlavha'])."</a></h2></hgroup>";
            echo "<p>".aslString($row['m_qisqa']);
            echo "<a href='?maqola=".$row['id_maqola']."'>davomi...</a></p></article>";
        }
    }
    function qidirish($kalit_soz){
        $sorov = 'select * from `maqolalar` where `m_matni` like "%'.$kalit_soz.'%"';
        $result = queryMysql($sorov);
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo '<article class="bolim"> <figure>';
            echo "<a href='?maqola=" . $row['id_maqola'] . "'><img src='images/" . $row['m_rasmi'] . "' alt='" .aslString($row['m_sarlavha']). "' /></a>";
            echo "<figcaption>" .aslString($row['m_sarlavha']). "</figcaption></figure>";
            echo "<hgroup><h2><a href='?maqola=" . $row['id_maqola'] . "'>" .aslString($row['m_sarlavha']). "</a></h2></hgroup>";
            echo "<p>" . $row['m_qisqa'];
            echo "<a href='?maqola=" . $row['id_maqola'] . "'>davomi...</a></p></article>";
        }
        $soni = $result->num_rows;
        if ($soni == 0){
            $sorov = 'select * from `maqolalar` where `m_sarlavha` like "%'.$kalit_soz.'%"';
            $result = queryMysql($sorov);
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo '<article class="bolim"> <figure>';
                echo "<a href='?maqola=" . $row['id_maqola'] . "'><img src='images/" . $row['m_rasmi'] . "' alt='" .aslString($row['m_sarlavha']). "' /></a>";
                echo "<figcaption>" .aslString($row['m_sarlavha']). "</figcaption></figure>";
                echo "<hgroup><h2><a href='?maqola=" . $row['id_maqola'] . "'>" .aslString($row['m_sarlavha']). "</a></h2></hgroup>";
                echo "<p>" . aslString($row['m_qisqa']);
                echo "<a href='?maqola=" . $row['id_maqola'] . "'>davomi...</a></p></article>";
            }
        }elseif($soni == 0){
            echo "<p class='search'>Uzir siz qidirgan kalit so`z bo`yicha malumot topilmadi</p>";
        }
    }
    function kalit_sozni_chiqarish($kalit_soz){
        $kalit = trim($kalit_soz);
        $a = explode(',',$kalit);
        foreach ($a as $kalit) {
            $sorov = 'select * from `maqolalar` where `m_matni` like "%'.$kalit.'%"';
            $result = queryMysql($sorov);
            $soni = $result->num_rows;
            if ($soni != 0){
                echo "<a href='?kalit_soz=".$kalit."'>".$kalit."(".$soni.")</a>";
            }else {
                $sorov = 'select * from `maqolalar` where `m_sarlavha` like "%' . $kalit . '%"';
                $result = queryMysql($sorov);
                $soni = $result->num_rows;
                if ($soni != 0) {
                    echo "<a href='?kalit_soz=" . $kalit . "'>" . $kalit . "(" . $soni . ")</a>";
                }
            }
            
        }
    }
?>