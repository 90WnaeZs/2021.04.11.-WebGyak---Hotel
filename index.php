<?php

require "dbcon.php";

if(isset($_SESSION["username"]))
{
    session_destroy();
}

session_start();
$db=new DBcon();
$db->Connection("hotel");

if(isset($_POST["sub"]) && isset($_POST["username"]) && isset($_POST["pw"]))
{
    $usern=$_POST["username"];
    $pw=$_POST["pw"];
    $_SESSION["username"]=$usern;
    if($db->Login($usern,$pw))
    {
        header("Location: logged.php");
    }
    else
    {
        echo "<script>alert('Hibás felhasználónév vagy jelszó!')</script>";
        $db->__destruct();
    }
}

if(isset($_POST["reg"]) && isset($_POST["username"]) && isset($_POST["pw"]))
{   
    $usern=$_POST["username"];
    $pw=$_POST["pw"];
    if($db->length_check($usern,$pw))
    {
        $db->Reg($usern,$pw);
    }
    
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css\bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="js\bootstrap.min.js"></script>
<script src="js\jquery-3.2.1.min.js"></script>
<script src="js\popper.min.js"></script>
<script src="kal.js"></script>
<title>Álomszép Hotel - oldal neve</title>
</head>

<body>
<div class="container-fluid bg-info wh">

<div class="d-flex justify-content-center"><img src="images/hotel.png" alt="hotel"/></div>

<nav class="navbar navbar-expand-sm nomarg light_background justify-content-center">
<ul class="navbar-nav">
<li class="nav-item"><a href="#" class="nav-link">Aktuális</a></li>
<li class="nav-item"><a href="#" class="nav-link">Foglalás</a></li>
<li class="nav-item"><a href="#" class="nav-link">Rólunk</a></li>
<li class="nav-item"><a href="#" class="nav-link">Kapcsolat</a></li>
</ul>
</nav>

<div id="cim" class="d-flex justify-content-center">
<h1 style="text-align:center">Álomszép hotel</h1>
</div>

<div id="tabla" class="table-borderless d-flex justify-content-center">
<table>
<tr>
    <td class="tbcol1">
        <h2>Kalkuláció</h2>
        <ul>
        <li>Idegenforgalmi adó: 300 Ft/fő</li>
        <li>Szállás díj: 15 000 Ft/fő/éj</li>
        </ul>
    </td>
    <td class="tbcol2">
                        Szállodánk kényelmes szobákkal várja kedves vendégeit, melyekben
                        klíma, széf, LCD Tv, hűtő,hajszárító illetve Wi-Fi hozzáférés szolgálja a vendégek kényelmét.
                        ​A szobák nagy része erkélyes, majdnem mind a kertben lévő medencére néz.
                        Saját kertünkben őrzött parkolási lehetőséget biztosítunk, díjmentesen. Családbarát
                        ​szálloda révén a kicsiknek játszótérrel,gyerek medencével és beltéri játékkuckóval kedveskedünk.               
    </td>
</tr>

<tr> 
        <td class="tbcol1" style="background-color:#6c757d;">
            <h2>Szállásdíj kalkulátor</h2>
            <form action="" class="marg20">
                <div class="form-group">
                    <label for="vendeg">Vendégek [fő]:</label>
                    <input class="form-control" type="number" id="vendeg" name="vendeg" placeholder="Vendégek száma" min="1" max="100" required>
                </div>

                <div class="form-group">
                    <label for="nap">Éjszakák [db]:</label>
                    <input class="form-control" type="number" id="nap" name="nap" placeholder="Éjszakák száma" min="1" max="20" required>
                </div>
                <input type="button" class="btn btn-primary" value="Számol" id="szamol" name="szamol">
            </form>
            </td>

        <td class="tbcol2">
            Számolja ki mennyibe kerül szállása! Írja be a szállóvendégek és az eltöltött éjszakák számát! A kalkulátor máris kiszámolja mennyi lesz a szállás díja.
        </td>
</tr>

<tr>
    <td class="tbcol1" style="background-color:#6c757d;">
        <div>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Felhasználónév:</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Írja be a felhasználónevét!" required>
                </div>
                <div class="form-group">
                    <label for="pw">Jelszó:</label>
                    <input type="text" class="form-control" id="pw" name="pw" placeholder="Írja be a jelszavát!" required>
                </div>
                    <input type="submit" class="btn btn-primary" id="sub" name="sub" value="Belépés">
                    <input type="submit" class="btn btn-primary" id="reg" name="reg" value="Regisztráció">
            </form>
        </div>
    </td>
    <td class="tbcol2">Ha már ügyfelünk, a megrendeléshez jelentkezzen be. Ha még nem ügyfelünk, adja meg a nevét és egy jelszót, majd kattintson a "Regisztráció" gombra.</td>
</tr>
</table>

</div>
</body>

</html>
