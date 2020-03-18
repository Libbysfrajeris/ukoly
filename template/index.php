<?php
require "Template.php";
echo "Funguje to";

$template = new Template("page.html");
$template->setData('title', 'TITULEK');
$template->setData('cokoliv', 'Tohle je muj template systém');
$template->setData('message', 'Ahoj, koronaprázdniny');
echo $template->render('page');
