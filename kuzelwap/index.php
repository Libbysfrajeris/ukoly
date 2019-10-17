<html>
    <head>
        <meta charset="UTF-8">
        <title>Kužel</title>
    </head>
    <body>
        <?php
        require 'ITeleso.php';
        require 'kuzel.php';

        $kuzel = new kuzel(9, 5);

        echo $kuzel->is3D();
        echo "<br> Kužel má " . $kuzel->pocetVrcholu() . " vrchol";
        echo "<br> Objem kuželu je " . $kuzel->objem() . " cm<sup>3</sup>";
        echo "<br> Povrch kuželu je " . $kuzel->povrch() . " cm<sup>2</sup>";
        ?>
    </body>
</html>
