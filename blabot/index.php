<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="newCascadeStyleSheet.css" rel="stylesheet" type="text/css"/>
        <title>Blábot</title>
    </head>
    <body>

        <div class="nadpis"><h1>Blábot</h1></div>

        <div class="text">

            <?php
            $filename = 'Podstatna jmena.csv';
            $podst_pole = [];

            if (($p = fopen("Podstatna jmena.csv", "r")) != false) {
                while (($podst = fgetcsv($p, 1000, ",")) != false) {
                    $podst_pole[] = $podst;
                }
                fclose($p);
            }

            $filename2 = 'slovesa.csv';
            $slovesa_pole = [];

            if (($s = fopen("slovesa.csv", "r")) != false) {
                while (($slovesa = fgetcsv($s, 1000, ",")) != false) {
                    $slovesa_pole[] = $slovesa;
                }
                fclose($s);
            }

            $filename3 = 'predlozky.csv';
            $predlozky_pole = [];

            if (($a = fopen("predlozky.csv", "r")) != false) {
                while (($predlozky = fgetcsv($a, 1000, ",")) != false) {
                    $predlozky_pole[] = $predlozky;
                }
                fclose($a);
            }

            $filename4 = 'spojky.csv';
            $spojky_pole = [];

            if (($b = fopen("spojky.csv", "r")) != false) {
                while (($spojky = fgetcsv($b, 1000, ",")) != false) {
                    $spojky_pole[] = $spojky;
                }
                fclose($b);
            }

            for ($i = 0; $i <= 60; $i++) {
                echo (ucfirst($podst_pole[rand(0, sizeof($podst_pole) - 1)][0]) . " "
                . $spojky_pole[rand(0, sizeof($spojky_pole) - 1)][0] . " "
                . $podst_pole[rand(0, sizeof($podst_pole) - 1)][0] . " "
                . $slovesa_pole[rand(0, sizeof($slovesa_pole) - 1)][0] . " "
                . $predlozky_pole[rand(0, sizeof($predlozky_pole) - 1)][0] . " "
                . $podst_pole[rand(0, sizeof($podst_pole) - 1)][0] . ". ");
            }
            ?> 

        </div>
        <img src="blábot.jpg" alt="blabot" style="width:150px;height:150px;">
        <div class="tlacitko">
            <form><input type=button value="Refresh" onClick="window.location.reload()"></form>
        </div>
    </body>
</html>
