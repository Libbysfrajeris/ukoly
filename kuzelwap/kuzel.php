<?php

class kuzel implements ITeleso {

    private $r; //poloměr
    private $v; //výška

    function __construct($r = 0, $v = 0) {
        $this->r = $r;
        $this->v = $v;
    }

    public function info(): string {
        
    }

    public function is3D(): bool {
        if ($this->r && $this->v != 0) { //pokud výška a poloměr není 0, jedná se o těleso
            echo "Je tělso";
            return TRUE;
        } else {
            echo "Není těleso";
            return FALSE;
        }
    }

    public function objem(): float {
        return (0.333) * pi() * pow($this->r, 2) * $this->v; //Objem kuželu V = 1/3πr²v
    }

    public function pocetVrcholu(): int {
        if ($this->r && $this->v != 0) { //
            return $vrchol = 1;
        } else {
            return $vrchol = 0;
        }
    }

    public function povrch(): float {
        $s = sqrt(pow($this->r, 2) + pow($this->v, 2)); //Poloměr pláště s = √r² + √v²
        return pi() * $this->r * ($this->r + $s); //Povrch kuželu S = πr(r + s)
    }

}
