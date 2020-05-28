
    
   <div id="main">
       <?php
       
          if(!empty($trazeno))
       {
           echo "<h5> Rezultati pretrage za {$trazeno} su: </h5>";
       }

        foreach ($data['news'] as $vest)
        {
                echo "<div class='deo1'>";
                echo "<h2> {$vest->Naziv} </h2>";
                echo '<img alt="computer" src="data:image/jpeg;base64,' . base64_encode($vest->Slika) . '" />';
                echo "<p> $vest->Opis</p>";
                   //$link = site_url("Korisnik/addtocart/{$vest->IdD}");
                    $cont = current_url(true)->getSegment(1);
                    if($cont == "") $cont = "Gost";
                    $link = site_url("$cont/addtocart/{$vest->IdD}");
                    //
                echo "<input type=\"submit\" value='Dodaj u korpu' class='dugme' link='$link'/> ";
                echo "</div>";
        }
   
         
      


       ?>
       <br>
       <?= $data['pager']->links() ?>
      
</div>

  
