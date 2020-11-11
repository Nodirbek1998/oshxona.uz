<?php
    session_start();
    include_once ('functions.php');

    if (!isset($_SESSION['user'])){
        die();
    }
	// o'zgaruvchilarga boshlang'ich qiymat berish
	$m_sarlavhaErr = $m_qisqaErr = $m_kalit_sozErr = $m_matniErr = $m_rasmiErr = '';
	$m_sarlavha = $m_qisqa= $m_kalit_soz = $m_matni = $m_rasmi = '';
	$m_bolim_id = 0;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		if (empty($_POST["m_sarlavha"])) {
	    	$m_sarlavhaErr = "Maqola sarlavhasi kiritilmadi";
	  	} else {
                $m_sarlavha = strtocode($_POST["m_sarlavha"]);
	  	}
        if (empty($_POST["m_qisqa"])) {
            $m_qisqaErr = "Maqolaning qisqa shakli kiritilmadi";
        } else {
            $m_qisqa= strtocode($_POST["m_qisqa"]);
        }
        if (empty($_POST["m_matni"])) {
            $m_matniErr = "Maqolaning matni kiritilmadi";
        } else {
            $m_matni= strtocode($_POST["m_matni"]);
        }

        $m_kalit_soz= strtocode($_POST["m_kalit_soz"]);
        $m_rasmi= strtocode($_POST["m_rasmi"]);
        $m_bolim_id= $_POST["m_bolim_id"];

        if (!(empty($m_sarlavha) && empty($m_qisqa) && empty($m_matni))){
            $sorov = "insert into `maqolalar` (`m_sarlavha`,`m_qisqa`,`m_kalit_soz`,`m_matni`,
                      `m_bolim_id`,`m_rasmi`) values('$m_sarlavha','$m_qisqa','$m_kalit_soz','$m_matni',
                      '$m_bolim_id','$m_rasmi');";
            $result  = queryMysql($sorov);
            if ($result){
                die("<h1>Maqola qo`shildi.
                    <a href='add.php'>Yana maqola qoshish</a></h1>");
            }
        }

	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Yangi maqola qo`shish</title>
    <style type="text/css">
        .qizil{color: red;}
    </style>
    <script src="../editor/ckeditor.js"></script>
</head>
<body>

<form method="post" action="<?php 
		echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
	<p><span class="qizil">*</span> to'ldirish majburiy 
				bo'lgan maydonlar</p>
	<table>
		<tr>
			<td>Maqola sarlavhasi:<br>
                <input type="text" size="100" name="m_sarlavha" value="<?php echo $m_sarlavha ?>">
				<span class="qizil">* <?php echo $m_sarlavhaErr;?> </span></td>
		</tr>
		<tr>
			<td>Maqolaning qisqa shakli:<br>
                <textarea name="m_qisqa" rows="5" cols="100"><?php echo $m_qisqa; ?></textarea>
				<span class="qizil">* <?php echo $m_qisqaErr;?></span></td>
		</tr>
		<tr>
			<td>
                Kalit so`zlarni vergul bilan kiriting:<br>
                <input size="100" type="text" name="m_kalit_soz" value="<?php echo $m_kalit_soz; ?>">
			<span class="qizil"> <?php echo $m_kalit_sozErr; ?> </span></td>
		</tr>
		<tr>
			<td>Maqola matni:<br>
                <textarea name="m_matni" id="editor1" rows="5" cols="100">
                    <?php echo $m_matni; ?>
            </textarea>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace( 'editor1' );
                </script>
                </td>
		</tr>
        <tr>
            <td>Maqola rasmiga yo`l ko`sating:<br>
                <input size="100" name="m_matni" type="text"><?php echo $m_matni; ?></td>
        </tr>
        <tr>
            <td>Maqolani qaysi bo`limga tegishli ekanini tanlang:<br>
                <select name="m_bolim_id">
                    <?php
                        $sorov = 'select * from menu';
                        $result = queryMysql($sorov);
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                            echo "<option value='".$row['id_menu']."'>".$row['nomi']."</option>";
                        }
                    ?>
                </select></td>
        </tr>
	</table>
	<input type="reset"  value="Tozalash" style="width:120px">
	<input type="submit" value="Yubor" style="width:120px">
</form>	
	<hr>
	
</body>
</html>


<!--
 /***************************************
  * PHP va MySQL video kursi            *
  * (C) 2009-2015 Qudrat Abdurahimov    *
  * http://dastur.uz                    *
  * http://qudrat.uz                    *
  * dasturchi@mail.ru                   *
  ***************************************/
-->