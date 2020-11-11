<?php
// o'zgaruvchilarga boshlang'ich qiymat berish
$nameErr = $emailErr = $commentErr = "";
$name = $email = $gender = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tekshirish= true;
    if (empty($_POST["name"])) {
        $nameErr = "Ism kiritilmadi";
        $tekshirish= false;
    } else {
        $name = sanitizeString($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Faqat harf va probel bo`lishi mumkin";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email kiritilmadi";
        $tekshirish= false;
    } else {
        $email = sanitizeString($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email noto`g`ri kiritildi";
            $tekshirish= false;
        }
    }
    if (empty($_POST["comment"])) {
        $comment = "";
       $commentErr = 'Xabar kiritilmadi';
        $tekshirish= false;
    } else {
        $comment =sanitizeString($_POST["comment"]);
    }
    if ($tekshirish == true){
        $sana = date('Y-m-d H:i:s');
        $sorov = "insert into `fikr` (`name`,`email`,`xabar`,`sana`) values('$name','$email','$comment','$sana') ";
        $result = queryMysql($sorov);
        echo "<p style='margin-left: 30px;'>Fikr bildirganingiz uchun rahmat</p>";
        return;
    }
}
?>

<article class="aloqa">
    <form method="post" action="<?php
    echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <p><span class="qizil">*</span> to'ldirish majburiy
            bo'lgan maydonlar</p>
        <table>
            <tr>
                <td>Ism:</td>
                <td><input type="text" name="name" value="<?php echo $name ?>">
                    <span class="qizil">* <?php echo $nameErr;?> </span></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><input type="text" name="email" value="<?php echo $email; ?>">
                    <span class="qizil">* <?php echo $emailErr;?></span></td>
            </tr>
            <tr>
                <td>Xabar</td>
                <td><textarea name="comment" rows="5" cols="22"><?php echo $comment; ?></textarea>
                    <span class="qizil">* <?php echo $commentErr;?> </span>
                </td>
            </tr>
        </table>
        <div class="reset">
            <input type="reset"  value="Tozalash" style="width:120px">
            <input type="submit" value="Yubor" style="width:120px">
        </div>
    </form>
    <hr>


<?php
    $sorov = 'select *from fikr where status = 1 order by id_fikr desc ';
    $result = queryMysql($sorov);
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo '<article class="xabar">';
        echo "<p>".$row['name'].' '.$row['sana']."</p>";
        echo "<p>" . $row['xabar'] ."</p></article>";
    }
?>

</article>