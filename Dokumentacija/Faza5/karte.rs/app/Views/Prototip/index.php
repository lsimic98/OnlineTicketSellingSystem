
    
   <div id="main">
       <?php
       if(!empty($trazeno))
       {
           echo "<h5> Rezultati pretrage za {$trazeno} su: </h5>";
       }



        foreach ($news as $vest)
        {
            echo "<div class='deo1'>";
            echo "<h2> {$vest->Naziv} </h2>";
            echo '<img alt="computer" src="data:image/jpeg;base64,'. base64_encode($vest->Slika) .'" />';
            echo "<p> $vest->Opis</p>";
            echo " <a href=\"#\"><input type=\"submit\" value=\"Kupi\" class=\"dugme\"/></a>";
            echo "</div>";
        }



       ?>
        <div class="deo1">
        <h2> Dogadjaj 1</h2>
        <img src="/images/exit.jfif" alt="computer">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, laborum, quae consequatur possimus quisquam velit assumenda repellendus nisi et dolorem at mollitia molestiae ut ducimus quasi obcaecati aliquam enim tempora sit nostrum distinctio omnis saepe voluptates tempore excepturi nam doloremque minima suscipit cupiditate nobis quod sapiente est atque? Mollitia dolore molestias repellendus aut id totam.	   </p>
        <a href="#"><input type="submit" value="Kupi" class="dugme"/></a>
       </div><!-- kraj deo 1 -->
	   <br>
	   <div class="pagination">
			<a href="#">&laquo;</a>
			<a class="active" href="#">1</a>
			<a href="#">2</a>
			<a href="#">3</a>
			<a href="#">4</a>
			<a href="#">5</a>
			<a href="#">6</a>
			<a href="#">&raquo;</a>
		</div>
</div>

         <div id="foot">
         <p>Copyright&copy;</p>
        </div><!-- kraj foot-->
    
    
    
    
    </div><!-- kraj wrap-->
</body>
</html>
