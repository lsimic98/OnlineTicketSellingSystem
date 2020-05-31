
   <div id="main">
       <div class="deo1">
           <h1 align="center"> <?php   echo "Admin $admin"; ?> </h1>
       </div><!-- kraj deo 1 -->
       
       
              <div class="dugmici">
    <a href="<?php echo site_url("Admin/adminMode");?>">
        <button id="dugmeZaKorisnike" formaction=""class="button" style="background-color:#4CAF50;"><span>Korisnici </span></button>
    </a>
    <a href="<?php echo site_url('Admin/adminOglasi');?>">
        <button id="dugmeZaOglase" formaction=""class="button" style="background-color:#4CAF50;"><span>Oglasi </span></button>
    </a>
</div>
       
       
       
       <div class ="pretrazi" align="right">
           <form method="post">
               <label>Pretrazi Oglase:</label><br>
               <tr>
                   <td>  <input type="text" name="pretraziKorisnike" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                    <td>  <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Admin/pretragaOglasa');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
               
               </tr>
           </form>
       </div>
       



        <div class="grid-container">

            <div class="grid-item"><span><b>Oglas</b></span></div>
            <div class="grid-item"><span><b>Status</b></span></div>
            <div class="grid-item"><span><b>Select</b></span> </div>
            <?php
            foreach ($data['news'] as $news)
            {?>
                <div class="grid-item"><?php echo $news->Naziv ?> </div>
                <div class="grid-item"><?php echo $news->Status ?> </div>
                <div class="grid-item"><input type="checkbox" value="<?php echo $news->IdD;?>" name="oglas"></div>
         <?php   }?>

            <div class="grid-item"><button id="statusOglasa" class="dugme" style="background-color:#4CAF50;">Status</button></div>

            <div class="grid-item"> </div>
            <div class="grid-item"><button id="obrisiOglas" class="dugme" style="background-color:#BF0000;">Ukloni</button></div>
          </div>


           <?= $data['pager']->links() ?>

   </div>

   <script type="text/javascript">
       $(document).ready(function() {
           $('#obrisiOglas').click(function(){
               alert("<?php echo base_url("Admin/index"); ?>");
               var favorite = [];
               $.each($("input[name='oglas']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/obrisiOglas"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
           });
           $('#statusOglasa').click(function(){
               alert("<?php echo base_url("Admin/Status"); ?>");
               var favorite = [];
               $.each($("input[name='oglas']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/promeniStatus"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
           });
       });
   </script>
