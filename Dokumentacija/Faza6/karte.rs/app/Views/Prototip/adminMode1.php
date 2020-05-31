
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
               <label>Pretrazi korisnike:</label><br>
               <tr>
                   <td>  <input type="text" name="pretraziKorisnike" class = "searchText"placeholder="Unesite tekst za pretragu"></td>
                   <td>  <button type="submit"class= "stupidButton" formaction="<?php echo site_url('Admin/pretragaKorisnika');?>"> <i class="fa fa-search" aria-hidden="true"></i></button></td>
               </tr>

           </form>
       </div>
    
        <div class="grid-container">

            <div class="grid-item"><span><b>Korisničko ime</b></span></div>
            <div class="grid-item"><span><b>Uloga</b></span></div>
            <div class="grid-item"><span><b>Selektovan</b></span> </div>
            <?php
            foreach ($data['news'] as $user)
            {?>
                <div class="grid-item"><?php echo $user->KorIme ?> </div>
                <div class="grid-item"><?php echo $user->Opis ?> </div>
                <div class="grid-item"><input type="checkbox" value="<?php echo $user->KorIme;?>" name="user"></div>
         <?php   }?>




            <div class="grid-item"><button id="add" class="dugme">Dodaj moderatora</button> </div>
            <div class="grid-item"><button id="delete" class="dugme" style="background-color:#31708f;">Oduzmi moderatora</button></div>
            <div class="grid-item"><button id="block" class="dugme" style="background-color:#BF0000;">Ukloni</button></div>
          </div>

       <?= $data['pager']->links() ?>

</div>
    
    <!-- kraj wrap-->


   <script type="text/javascript">
       $(document).ready(function() {

           $('#add').click(function(){
               alert("<?php echo base_url("Admin/index"); ?>");
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/dodajModeratora"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
           });
           $('#block').click(function(){
               alert("<?php echo base_url("Admin/ukloni"); ?>");
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/ukloni"); ?>',
                   type:"POST",
                   data: {favorite: favorite},
                   dataType: 'json',
                   success: function(msg){
                       $("#proba").html(msg.favorite)
                   }
               });
           });
           $('#delete').click(function(){
               alert("<?php echo base_url("Admin/index"); ?>");
               var favorite = [];
               $.each($("input[name='user']:checked"), function(){
                   favorite.push($(this).val());
               });
               $.ajax({
                   url:'<?php echo site_url("Admin/oduzmiModeratora"); ?>',
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
