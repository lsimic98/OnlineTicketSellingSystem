<html>
<head>
    
    <script src="/script/nazad.js"></script>
</head>


<body>
    <div id="wrapper">

   <div id="main">
   <h1 align="center"><?php echo $naslov?></h1>
   <form action="<?php if($korisnik!=null)echo site_url('Korisnik/azurirajProfil'); else echo site_url('Gost/registracija'); ?>" method="post">
	<ul class="form-style-1">
    <li><label>Ime i prezime:<span class="required">*</span></label>
        <input type="text" name="ime" class="field-divided" placeholder="Ime" value="<?php if($korisnik!=null) echo $korisnik->Ime; ?>"/>
        <input type="text" name="prezime" class="field-divided" placeholder="Prezime" value="<?php if($korisnik!=null) echo $korisnik->Prezime; ?>"/></li>
    <li>
        <label>Email: <span class="required">*</span></label>
        <input type="email" name="email" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Email; ?>"/>
    </li>
		<li>
        <label>Korisničko ime: <span class="required">*</span></label>
        <input type="text" name="korime" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->KorIme; ?>"  <?php if($korisnik!=null)echo 'readonly';?>/>
    </li>
	 <li>
        <label><?php  if($korisnik!=null) echo 'Stara šifra:'; else echo 'Šifra:';?><span class="required">*</span></label>
        <input type="password" name="lozinka" class="field-long" />
    </li>
	 <li>
        <label><?php  if($korisnik!=null) echo 'Nova šifra:'; else echo 'Ponovljena šifra:';?><span class="required">*</span></label>
        <input type="password" name="ponlozinka" class="field-long" />
    </li>
		 <li>
        <label>Telefon: <span class="required">*</span></label>
        <input type="text" name="telefon" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Telefon; ?>"/>
    </li>
		
		 <li>
        <label>Brlk: <span class="required">*</span></label>
        <input type="text" name="brlk" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->BRLK;?>"/>
    </li>

    <li>
        <label>Država<span class="required">*</span></label>
        <!--input type="text" name="field3" class="field-long" /-->
        <select id="drzava" name="drzava" class="field-long">
            <option value="Srbija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Srbija')echo 'selected';?>>Srbija</option>
            <option value="Hrvatska" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Hrvatska')echo 'selected';?>>Hrvatska</option>
            <option value="Severna Makedonija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Severna Makedonija')echo 'selected';?>>Makedonija</option>
            <option value="Bosna i Hercegovina" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Bosna')echo 'selected';?>>Bosna i Hercegovina</option>
            <option value="Slovenija" <?php if($korisnik!=null and (string)$korisnik->Drzava=='Slovenija')echo 'selected';?>>Slovenija</option>
        </select>
    </li>
	


	<li>
        <label>Grad<span class="required">*</span></label>
        <input type="text" name="grad" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Grad; ?>"/>
    </li>

    <li>
        <label>Adresa<span class="required">*</span></label>
        <input type="text" name="adresa" class="field-long" value="<?php if($korisnik!=null) echo $korisnik->Adresa; ?>"/>
    </li>
        <?php if(isset($poruka)) echo "<font color='green' size='5px'>$poruka</font><br>"; ?>
    <li>
        <input type="submit" value="Pošalji" /> <input type="button" value="Odustani" onclick="nazad('<?php echo site_url('Korisnik/userInfo');?>')"/>
    </li>
</ul>
</form>
      
       
       
       </div>
      
   
        
       
    
    
    
    
    </div><!-- kraj wrap-->

</body>
</html>