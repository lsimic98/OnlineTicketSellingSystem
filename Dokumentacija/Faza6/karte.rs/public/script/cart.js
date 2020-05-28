$(window).on('load', function(){

    var $addbuttons = jQuery('.dugme')
    $addbuttons.click(function(){
        $link = $(this).attr('link');
        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                    // This function is called if your AJAX query was successful
                    //alert("Response is: " + data);
                    },
            error: function() {
                    // This callback is called if your AJAX query has failed
                    //alert("Error!");
            }
        });
    });

    var $cartbuttons = jQuery('.dugmecart')
    $cartbuttons.click(function(){

        $kol = $(this).attr('kol');
        $cena = $(this).attr('cena');
        $iddog = $(this).attr('iddog');
        $opt = $(this).attr('opt');
        $suma = parseInt($("#suma").text());

        if($opt == 0)
        {
            $kol++;
            $(this).next().attr('kol', $kol);
            $suma += parseInt($cena);
            $("#suma").text($suma);
        }
        else
        {
            if($kol > 1)
            {
                $kol = $kol - 1;
                $suma -= parseInt($cena);
                $(this).prev().attr('kol', $kol);
                $("#suma").text($suma)
            }

        }

        $cena = $kol * $cena;
        $(this).attr('kol', $kol);
        $("#kol"+$iddog).text($kol);
        $("#cena"+$iddog).text($cena);
        /*document.getElementById("kol" + $iddog).innerHTML = $kol;
        document.getElementById("cena" + $iddog).innerHTML = $cena;*/

        $link = $(this).attr('link');
        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                // This function is called if your AJAX query was successful
                //alert("Response is: " + data);
            },
            error: function() {
                // This callback is called if your AJAX query has failed
                //alert("Error!");
            }
        });
    });

    var $delbuttons = jQuery('.dugmecartdel')
    $delbuttons.click(function(){
        $iddog = $(this).attr('iddog');
        $("#" + $iddog).css("display", "none");

        $link = $(this).attr('link');
        $suma = parseInt($("#suma").text());
        $minus = parseInt($("#cena"+$iddog).text());
        $suma -= $minus;
        $("#suma").text($suma);

        $.ajax({
            url: $link,
            cache: false,
            type: 'POST', // GET or POST
            //data: 'add=', // will be in $_POST on PHP side
            success: function(data) { // data is the response from your php script
                // This function is called if your AJAX query was successful
                //alert("Response is: " + data);
            },
            error: function() {
                // This callback is called if your AJAX query has failed
                //alert("Error!");
            }
        });
    });



});