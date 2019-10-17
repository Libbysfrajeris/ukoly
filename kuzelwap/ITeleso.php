<?php

interface ITeleso {

    public function povrch(): float;//funkce pro povrch kuželu

    public function objem(): float;//funkce pro objem kuželu

    public function is3D(): bool;//funkce zda je kužel těleso

    public function pocetVrcholu(): int;//funkce, která zjistí kolik má kužel vrcholů

    public function info(): string;//funkce, která informuje
}

?>