<?php
    session_start();
    include_once ('inc/functions.php');
    if (isset($_GET['chiqish'])){
        destroySession();
        $s = 'Refresh:0; url='.SITE;
        header($s);

    }

    if (isset($_POST['name']) && isset($_POST['password'])){
            $name = sanitizeString($_POST['name']);
            $password = sanitizeString($_POST['password']);
            if ($name == 'Nodirbek' && $password == '1972'){
                $_SESSION['user'] = "Nodirbek";
                $s = 'Refresh:0; url='.SITE.'/inc/list.php';
                header($s);
            }else{
                echo "Xato kiritildi";
            }
    }


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminka</title>
</head>
<body>
    <form action="admin.php" method="post">
        Name: <input type="text" name="name">
        Password: <input type="password" name="password">
         <input type="submit" value="Kirish">
         <input type="reset" value="Tozalash">
    </form>
</body>
</html>