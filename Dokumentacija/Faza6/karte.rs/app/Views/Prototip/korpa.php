<!-- Page Content -->



<div id="main">

<div class="container">


    <!-- /.row -->

    <div class="row">
        <h1 align="center">Plaćanje</h1>

        <!--div class="col-xs-4 pull-right ">
            <h2>Ukupan iznos</h2>

            <table class="table table-bordered" cellspacing="0">


                <tr class="order-total">
                    <th>Suma korpe:</th>
                    <td><strong><span class="amount" id="suma">
                                <?php/*
                                $suma = 0;
                                foreach ($news as $vest) {
                                    $kolicina = $_SESSION['korpa'][$vest->IdD];
                                    $cena = $kolicina * $vest->Cena;
                                    $suma += $cena;
                                }
                                echo $suma;*/

                                ?>



                    </span></strong> </td>
                </tr>


                </tbody>

            </table>

        </div-->
        <form action="<?= site_url("Korisnik/kupi") ?>"" method="post">

        <ul class="form-style-2 table-responsive">
            <li>
            <table>
                <thead>
                <tr>
                    <th>Slika</th>
                    <th>Naziv</th>
                    <th>Kolicina</th>
                    <th>Ukupno</th>
                    <th>Opcije</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($news as $vest)
                {
                    $kolicina = $_SESSION['korpa'][$vest->IdD];
                    $cena  = $kolicina * $vest->Cena;

                    $cont = current_url(true)->getSegment(1);
                    if($cont == "") $cont = "Gost";

                    $linkinc = site_url("$cont/inccart/{$vest->IdD}");
                    $linkdec = site_url("$cont/deccart/{$vest->IdD}");
                    $linkdel = site_url("$cont/delcart/{$vest->IdD}");
                    $slika = base64_encode($vest->Slika);
                    $product = <<<DEL

                        <tr id="$vest->IdD">
                          <td> <img alt="computer" src='data:image/jpeg;base64,$slika' width="160em" height="90em"/></td>
                          <td>{$vest->Naziv}</td>
                          <td id = "kol$vest->IdD">{$kolicina} </td>
                          <td id = "cena$vest->IdD">{$cena}</td>
                          <td>
                              <button type="button" class="dugmecart" link = '$linkinc' kol = '$kolicina' cena = '$vest->Cena' iddog = '$vest->IdD' opt = '0'>+</button>
                              <button type="button" class="dugmecart" link = '$linkdec' kol = '$kolicina' cena = '$vest->Cena' iddog = '$vest->IdD' opt = '1'>-</button> 
                              <button type="button" class="dugmecartdel" link = '$linkdel' iddog = '$vest->IdD'>delete</button></td>
                          </tr>
DEL;
                    echo $product;
                    
                }


                ?>
                <tr>
                    <td colspan="5">
                        <div class="col-xs-4">


            <?php
                                $suma = 0;
                                foreach ($news as $vest) {
                                    $kolicina = $_SESSION['korpa'][$vest->IdD];
                                    $cena = $kolicina * $vest->Cena;
                                    $suma += $cena;
                                }
                                echo "<h2>Ukupan iznos: <span id = 'suma'>$suma</span></h2>";

                        ?>






        </div>


                    </td>
                </tr>
                </tbody>
            </table>
            </li>
        </ul>
                <ul class="form-style-1">

            <li>
                <label>Broj kartice<span class="required">*</span></label>
                <input type="text" name="brkartice" class="field-long" />
            </li>

            <li>
                <label>Broj isteka važenja kartice (mesec/godina)<span class="required">*</span></label>
                <input type="text" name="mesec" class="field-divided" placeholder="Mesec" />
                <input type="text" name="god" class="field-divided" placeholder="Godina" />
            </li>

            <li>
                <label>CVC/CVV2 kod<span class="required">*</span></label>
                <input type="text" name="cvc" class="field-long" />
            </li>


            <li>
            <input id = "kupi" type="submit" name="submit">
            </li>
        </ul>
        </form>


        <!--  ***********CART TOTALS*************-->

        <!-- CART TOTALS-->


    </div><!--Main Content-->


</div>
</div>

<!-- /.container -->