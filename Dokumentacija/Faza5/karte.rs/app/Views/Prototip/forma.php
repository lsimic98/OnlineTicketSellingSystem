
<body>

    <div id="wrapper">

   <div id="main">
   <h1 align="center"> Registracija</h1>
   <form action="<?= site_url("Gost/registracija") ?>" method="post">
	<ul class="form-style-1">
    <li><label>Ime i prezime:<span class="required">*</span></label>
        <input type="text" name="ime" class="field-divided" placeholder="Ime" />
        <input type="text" name="prezime" class="field-divided" placeholder="Prezime" /></li>
    <li>
        <label>Email: <span class="required">*</span></label>
        <input type="email" name="email" class="field-long" />
    </li>
		<li>
        <label>Korisničko ime: <span class="required">*</span></label>
        <input type="text" name="korime" class="field-long" />
    </li>
	 <li>
        <label>Šifra:<span class="required">*</span></label>
        <input type="password" name="lozinka" class="field-long" />
    </li>
	 <li>
        <label>Ponovljenja šifra: <span class="required">*</span></label>
        <input type="password" name="ponlozinka" class="field-long" />
    </li>
		 <li>
        <label>Telefon: <span class="required">*</span></label>
        <input type="text" name="telefon" class="field-long" />
    </li>
		 <li>
        <label>JMBG: <span class="required">*</span></label>
        <input type="text" name="jmbg" class="field-long" />
    </li>
		 <li>
        <label>Brlk: <span class="required">*</span></label>
        <input type="text" name="brlk" class="field-long" />
    </li>

    <li>
        <label>Država<span class="required">*</span></label>
        <!--input type="text" name="field3" class="field-long" /-->
        <select id="drzava" name="drzava" class="field-long">
            <option value="srbija">Srbija</option>
            <option value="hrvatska">Hrvatska</option>
            <option value="smakedonija">Severna Makedonija</option>
            <option value="bosna">Bosna i Hercegovina</option>
            <option value="slovenija">Slovenija</option>
        </select>
    </li>
	
	<li>
        <label>Poštanski broj<span class="required">*</span></label>
        <input type="text" name="posbr" class="field-long" />
    </li>

	<li>
        <label>Grad<span class="required">*</span></label>
        <input type="text" name="grad" class="field-long" />
    </li>

    <li>
        <label>Adresa<span class="required">*</span></label>
        <input type="text" name="adresa" class="field-long" />
    </li>
        <?php if(isset($poruka)) echo "<font color='green' size='5px'>$poruka</font><br>"; ?>
    <li>
        <input type="submit" value="Pošalji" />
    </li>
</ul>
</form>
      
       
       
       </div>
      
   
        
         <div id="foot">
         <p>Copyright&copy;</p>
        </div><!-- kraj foot-->
    
    
    
    
    </div><!-- kraj wrap-->
</body>
</html>
