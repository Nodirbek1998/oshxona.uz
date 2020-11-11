<?php
    require_once ("inc/functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chustiy oshxonasi</title>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <link rel="stylesheet" href="css/menu.css">
        <link rel="Stylesheet" href=" css/nodir.css" />
        <script type="text/javascript" src="../yoxview/yoxview-init.js"></script>
	</head>
	<body>
		<div class="wrapper">
            <?php
            include ("inc/menu.php");
            ?>
			<section class="courses">
                <?php
                    include ('inc/content.php');
                ?>
			</section>
			<aside>
                    <?php include ('inc/popular.php')?>
                <form action="index.php" method="get">
                    <input type="text" name="kalit_soz">
                    <input type="submit" value="izlash">
                </form>
                <section class="contact-details">
                    <h2>Manzil</h2>
                    <p>Toshkent shahri <br>
                        Samarqand Darvoza 5-etaj<br />
                        Chustiy Cuisine restorani<br />
                    </p>

                </section>
                <hr>
                <p>Bahriddin Chustiyga oshxona.uz sayti ma'lumotlaridan foydalanib sayt tuzishni
                    o'rgatishga ruxsat bergani uchun minnatdorchilik bildiraman.</p>

                <hr>

                Asl oshxona.uz sayti ushubu saytdan ancha chiroyli va afzal. Bu yerda faqat bo'lajak web dasturchilarga
                PHP da sayt qilish o'rgatildi. Ya'ni birinchi marta ishlab chiqilgan sayt uchun kifoya qiladigan narsalar o'rgatildi.
			</aside>
			<footer>
                &copy; Bahriddin Chustiy
			</footer>
		</div><!-- .wrapper -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(".yoxview").yoxview();
            });
        </script>
	</body>
</html>