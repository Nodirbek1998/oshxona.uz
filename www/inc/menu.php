<header>
    <h1>Nodirbek Mamadaliyev</h1>
    <nav>
        <ul>
            <li><a href="<?php echo SITE?>" class="current">Bosh sahifa</a></li>
            <?php
                $sorov = 'select * from menu';
                $result = queryMysql($sorov);
                while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                    echo " <li><a href='?bolim=".$row['id_menu']."'>".$row['nomi']."</a></li>";
                }
            ?>
            <li><a href="?bolim=55">Gallery</a></li>
            <li><a href="?bolim=0">Biz bilan aloqa</a></li>
        </ul>
    </nav>
</header>