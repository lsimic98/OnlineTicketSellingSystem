<?php

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>karte.rs</title>
<link href="/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
<script type=text/javascript src="/script/proba.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/script/cart.js"></script>

</head>

<body>

    <div id="wrapper">

    <div id="head">

    	<div id="logo">
        <a href = "<?php echo site_url("Admin/index"); ?>"><img src="/images/logo3.png" alt="logo" width="200" height="70"></a>


        </div><!-- kraj logo-->

            <div id="nav" class="myTopNav">
                <ul>
                    <li><a class="<?php if($method=='index') echo 'current';?>" href="<?php echo site_url("Admin/index"); ?>" >Početna</a></li>
                    <li><a class="<?php if($method=='korpa') echo 'current';?>"  href="<?php echo site_url("Admin/korpa"); ?>" >Korpa</a></li>
                    <li><a class="<?php if($method=='userInfo') echo 'current';?>" href="<?php echo site_url("Admin/userInfo"); ?>">Korisnički profil</a></li>
                     <li><a href="<?php echo site_url("Admin/oglasi"); ?>" >Prodaja Karata</a></li>
       
                 </ul>
        </div><!-- kraj nav-->
    <div class="searchBar">
        <table>
            <form class="example">
            <tr>
                <td>  <input type="text" name="search" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                <td>  <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Admin/pretraga');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
            </tr>
        </form>
        </table>
    </div>

    <div id="korisnik">
        <span style="color:white"> <?php  echo"Dobrodosao ".$user->Ime ?>  <?= anchor("Korisnik/logout", "Izloguj se") ?></span>
    </div>
    <div class="icon">
        <a href="javascript:void(0);"  onclick="myFunction()"><i class="fa fa-bars"></i></a>
    </div>

    </div><!-- kraj head-->
