<section class="popular-recipes">
    <h2>Ko'p o'qilganlar</h2>
    <?php
    $sorov = 'SELECT * FROM `maqolalar` ORDER BY `m_oqildi` DESC LIMIT 0,6';
    $result = queryMysql($sorov);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        $oqildi = $row['m_oqildi'];
        echo "<a href='?maqola=".$row['id_maqola']."'>".$row['m_sarlavha']."(".$oqildi.")</a></p></article>";
    }
    ?>
</section>