<script>
    function goBack(var page)
    {
        return window.location.href=page;
    }



</script>
    
   <div id="main">
   <h1 align="center"><?php echo $naslov?></h1>
   <form class="formaKarte" action="<?php if($news!=null)echo site_url('Korisnik/azurirajOglas/'.$news[0]->IdD); else echo site_url('Korisnik/ubaciOglas');?>" enctype="multipart/form-data" method="post">
	<ul class="form-style-1 prodajaKarata">
    <li><label>Naziv:<span class="required">*</span></label>
        <input type="text" name="naziv" class="field-long" placeholder="Naziv dogadjaja" value="<?php if($news!=null)echo $news[0]->Naziv;?>"/> </li>

        <li>
            <label>Broj Karata: <span class="required">*</span></label>
            <input type="number" name="brojkarata" class="field-long" value="<?php if($news!=null)echo $news[0]->BrojKarata;?>"/>
        </li>
        <li>
            <label>Cena: <span class="required">*</span></label>
            <input type="number" name="cena" class="field-long" value="<?php if($news!=null)echo $news[0]->Cena;?>"/>
        </li>
    <li>
        <label>Datum: <span class="required">*</span></label>
        <input type="date" name="datum"class="field-long" placeholder="Datum dogadjaja" 
            value="<?php if($news!=null){ 
                $arr = explode(' ', $news[0]->Datum, 2);
                echo $arr[0];
            }
            ?>"/>
    </li>
    <li>
        <label>Vreme: <span class="required">*</span></label>
        <input type="time" name="vreme" class="field-long"" placeholder="Vreme dogadjaja" 
               value="<?php if($news!=null){ 
                //$arr = explode(' ', $news[0]->Datum, 2);
                echo $arr[1];
            }
            ?>"/>
    </li>
	 <li>
        <label>Lokacija <span class="required">*</span></label>
        <input type="text" name="lokacija" class="field-long" placeholder="Lokacija odrzavanja" value="<?php if($news!=null)echo $news[0]->Lokacija;?>"/>
    </li>
 

		 <li>
        <label>Kontakt telefon <span class="required">*</span></label>
        <input type="text" name="telefon" class="field-long" value="<?php if($news!=null)echo $news[0]->Telefon;?>"/>
    </li>
    <li>
        <label>Dodajte sliku:<span class="required">*</span></label>
        <input type="file" name="slika" accept="image/png, image/jpeg"/>
        <span></span>
    </li>
    
    <li>
    <input type="submit" value="<?php if($news!=null)echo 'Izmeni olgas'; else echo 'Dodaj oglas';?>" /> <input type="button" value="Odustani" onClick='goBack("http://localhost:8080/Korisnik/userInfo")'/>
    </li>
    </ul>
    </form>
  </div>
 
    
    
    
