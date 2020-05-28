<?php

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>karte.rs</title>

    <link rel="stylesheet" type="text/css" href="/css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
<script type=text/javascript src="/script/proba.js"></script>
    <script src="/script/valid.js"></script>
    <script src="/script/cart.js"></script>

</head>

<body>

    <div id="wrapper">

    <div id="head">

    	<div id="logo">
        <a href = "index.php"><img src="/images/logo3.png" alt="logo" width="200" height="70"></a>


        </div><!-- kraj logo-->

            <div id="nav" class="myTopNav">
                <ul>
                    <li><a class="<?php if($method=='index') echo 'current';?>" href="index.php" >Početna</a></li>
                    <li><a class="<?php if($method=='korpa') echo 'current';?>"  href="<?php echo site_url("Gost/korpa"); ?>" >Korpa</a></li>
                     <li><a class="<?php if($method=='forma') echo 'current';?>" href="<?php echo site_url("Gost/forma"); ?>" >Registracija</a></li>
                     <li><a class="<?php if($method=='login') echo 'current';?>" href="<?php echo site_url("Gost/login"); ?>">Logovanje</a></li>
                     <li><a class="<?php if($method=='oglasi') echo 'current';?>" href="oglasi.html" >Prodaja Karata</a></li>
                 </ul>
        </div><!-- kraj nav-->
    <div class="searchBar">
        <table>
            <form class="example" >
            <tr>
                <td>  <input type="text" name="search" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                <td>    <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Gost/pretraga');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
            </tr>
        </form>
        </table>
    </div>

    <div id="korisnik">
        <span>  <?= anchor("Gost/login", "Prijavi se") ?></span>
    </div>
    <div class="icon">
        <a href="javascript:void(0);"  onclick="myFunction()"><i class="fa fa-bars"></i></a>
    </div>

    </div><!-- kraj head-->