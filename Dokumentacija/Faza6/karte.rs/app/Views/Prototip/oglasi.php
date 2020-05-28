

<body>

<div id="wrapper">
   <div id="main">
       <div id="oglas">
         <h1> Oglasi</h1>
           <?php
           $uri = current_url(true)->getSegment(1);
           $str=null;
           switch ($uri) {
               case "Gost":
               {
                   $str = site_url('Gost/login');
                   $_SESSION["msg"] = "Morate se ulogovati da bi postavljali oglase!";
                   break;
               }
               case "Korisnik":
                   $str = site_url('Korisnik/objaviOglas');
                   break;
               case "Admin":
                   $str = site_url('Admin/objaviOglas');
                   break;
           }
           ?>
          <a href="<?php echo $str?>">
              <button id="block" formaction=""class="button" style="background-color:#4CAF50;"><span>Dodaj </span></button>
          </a>
       </div>

       <?php
       foreach ($data['news'] as $oglas)
       {
          // echo "$str ";
           echo " <div class=\"deo1 oglas\" >";
           echo  "<h4>$oglas->Naziv </h4>";
           echo  " <table class=\"tabelaOglasi\">";
           echo  ' <tr><td rowspan="7"><img alt="computer" src="data:image/jpeg;base64,' . base64_encode($oglas->Slika) . '" /></td>';
                   /// <td rowspan='7'> <img alt=\'computer\' src=\'data:image/jpeg;base64,'". base64_encode($oglas->Slika)."></td>
           
           $date = date_create($oglas->Datum);
           $date = date_format($date, 'd.m.Y H:i');
           $arr = explode(' ', $date, 2);
           //echo $arr[0];
           echo "<th> Datum:</th> <td>{$arr[0]}</td></tr>";
                //</tr>";
           echo " <tr>
                    <th> Vreme:</th> <td>{$arr[1]}</td>         
                </tr>";
           echo "   <tr>
                    <th> Lokacija:</th> <td>$oglas->Lokacija</td>         
                </tr>";
           echo "    <tr>
                    <th> Prodavac:</th> <td>$oglas->KorIme</td>         
                </tr>";
           echo "  <tr>
                    <th> Broj karata:</th> <td>$oglas->BrojKarata</td>         
                </tr>";
           echo " <tr>
                    <th> Kontakt:</th> <td>{$oglas->Telefon}</td>         
                </tr>";
           echo "
                <tr>
                    <th>Cena:</th> <td>$oglas->Cena din</td>         
                </tr>";
           echo "  </table>";
           echo "</div>";

       }

       ?>


        <br>
   </div><!-- kraj za div main-->

		<div class="pagination" >
            <?= $data['pager']->links() ?>
		</div>


    
    </div><!-- kraj wrap-->

