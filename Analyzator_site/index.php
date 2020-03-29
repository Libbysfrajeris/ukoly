<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Analyzátor sítě</title>
</head>

<body>

    <? //VYTVOŘENÍ JEDNODUCHÉHO FORMULÁŘE 
    ?>
    <form action="index.php" method="POST">
        <h3>Zadejte síť</h3>

        <div class="form">
            <label for="oktet1">První oktet</label>
            <input type="number" name="oktet1" value="" maxlength="8">

            <label for="oktet2">Druhý oktet</label>
            <input type="number" name="oktet2" value="" maxlength="8">

            <label for="oktet3">Třetí oktet</label>
            <input type="number" name="oktet3" value="" maxlength="8">


            <label for="oktet4">Čtvrtý oktet</label>
            <input type="number" name="oktet4" value="" maxlength="8">


            <label for="prefix">Prefix /</label>
            <input type="number" name="prefix" value="" maxlength="2">

            <input class="submit" type="submit" name="submit" value="submit">
    </form>
    <?php echo "<br>"; ?>

    <?php
    $oktet1 = filter_input(INPUT_POST, "oktet1");
    $oktet2 = filter_input(INPUT_POST, "oktet2");
    $oktet3 = filter_input(INPUT_POST, "oktet3");
    $oktet4 = filter_input(INPUT_POST, "oktet4");
    $prefix = filter_input(INPUT_POST, "prefix");


    function maska($prefix)
    {
        $maska = null;
        for ($i = 0; $i < $prefix; $i++) {
            $maska .= 1;
        }
        for ($prefix; $prefix < 32; $prefix++) {
            $maska .= 0;
        }

        $arrMaska = str_split($maska, 8);

        return bindec($arrMaska[0]) . "." . bindec($arrMaska[1]) . "." . bindec($arrMaska[2]) . "." . bindec($arrMaska[3]);
    }

    function splitingOktet($prefix)
    {
        $oktet = null;
        while ($prefix >= 0) {
            $prefix -= 8;
            $oktet++;
        }
        return $oktet;
    }

    function Network($prefix, $oktet1, $oktet2, $oktet3, $oktet4)
    {
        $return = null;
        $oktet = splitingOktet($prefix);
        $pocetJednicek = $prefix % 8;

        switch ($oktet) {
            case 1:
                $number = $oktet1;
                break;
            case 2:
                $number = $oktet2;
                $return .= $oktet1 . ".";
                break;
            case 3:
                $number = $oktet3;
                $return .= $oktet1 . "." . $oktet2 . ".";
                break;
            case 4:
                $number = $oktet4;
                $return .= $oktet1 . "." . $oktet2 . "." . $oktet3 . ".";
                break;
        }
        $number = sprintf("%08d", decbin($number));

        implode(" ", $arrnumber = str_split($number));
        for ($pocetJednicek; $pocetJednicek < 8; $pocetJednicek++) {
            $arrnumber[$pocetJednicek] = 0;
        }
        $return .= bindec(implode("", $arrnumber));

        switch ($oktet) {
            case 1:
                $return .= "." . "0" . "." . "0" . "." . "0";
                break;
            case 2:
                $return .= "." . "0" . "." . "0";
                break;
            case 3:
                $return .= "." . "0";
                break;
            case 4:
                break;
        }
        return $return;
    }


    function Broadcast($prefix, $oktet1, $oktet2, $oktet3, $oktet4)
    {
        $return = null;
        $oktet = splitingOktet($prefix);

        switch ($oktet) {
            case 1:
                $number = $oktet1;
                break;
            case 2:
                $number = $oktet2;
                $return .= $oktet1 . ".";
                break;
            case 3:
                $number = $oktet3;
                $return .= $oktet1 . "." . $oktet2 . ".";
                break;
            case 4:
                $number = $oktet4;
                $return .= $oktet1 . "." . $oktet2 . "." . $oktet3 . ".";
                break;
        }


        $number = sprintf("%08d", decbin($number));

        $pocetJednicek = $prefix % 8;


        implode(" ", $arrnumber = str_split($number));
        for ($pocetJednicek; $pocetJednicek < 8; $pocetJednicek++) {
            $arrnumber[$pocetJednicek] = 1;
        }
        $return .= bindec(implode("", $arrnumber));

        switch ($oktet) {
            case 1:
                $return .= "." . bindec(11111111) . "." . bindec(11111111) . "." . bindec(11111111);
                break;
            case 2:
                $return .= "." . bindec(11111111) . "." . bindec(11111111);
                break;
            case 3:
                $return .= "." . bindec(11111111);
                break;
            case 4:
                break;
        }
        return $return;
    }

    function Oktet1($network)
    {
        $arr = str_split($network);
        $arr[sizeof($arr) - 1] += 1;
        return implode("", $arr);
    }

    function Last($broadcast)
    {
        $arr = str_split($broadcast);
        $arr[sizeof($arr) - 1] -= 1;
        return implode("", $arr);
    }



    echo "<h3>Normálně:</h3>Maska: ";
    echo maska($prefix);
    echo "<br>Network:";
    echo Network($prefix, $oktet1, $oktet2, $oktet3, $oktet4);
    echo "<br>First:";
    echo Oktet1(Network($prefix, $oktet1, $oktet2, $oktet3, $oktet4));
    echo "<br>Last:";
    echo Last(Broadcast($prefix, $oktet1, $oktet2, $oktet3, $oktet4));
    echo "<br>Broadcast:";
    echo Broadcast($prefix, $oktet1, $oktet2, $oktet3, $oktet4);
    echo "<br>";


    echo "<br><h3>Binárně:</h3>Maska: ";
    echo decbin(maska($prefix));
    echo "<br>Network:";
    echo decbin(Network($prefix, $oktet1, $oktet2, $oktet3, $oktet4));
    echo "<br>First:";
    echo decbin(Oktet1(Network($prefix, $oktet1, $oktet2, $oktet3, $oktet4)));
    echo "<br>Last:";
    echo decbin(Last(Broadcast($prefix, $oktet1, $oktet2, $oktet3, $oktet4)));
    echo "<br>Broadcast:";
    echo decbin(Broadcast($prefix, $oktet1, $oktet2, $oktet3, $oktet4));

    ?> </body>

</html>