<?php
class PartidoBasquet extends Partido{
    private $infracciones;
    private $coefPenalizacion;
    public function __construct($idPartido, $fecha, $objEquipo1,$cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase, $infracciones)
    {
        parent::__construct($idPartido, $fecha, $objEquipo1,$cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase);
        $this->infracciones = $infracciones;
        $this->coefPenalizacion = 0.75;
    
    }

    public function setInfracciones($infracciones) {
        $this->infracciones = $infracciones;
    }

    public function getInfracciones() {
        return $this->infracciones;
    }

    public function setCoefPenalizacion($coefPenalizacion) {
        $this->coefPenalizacion = $coefPenalizacion;
    }

    public function getCoefPenalizacion() {
        return $this->coefPenalizacion;
    }
    /* metodo coeficientePartido() */
    public function coeficientePartido()
    {
        $coeficiente = parent::coeficientePartido()-($this->getCoefPenalizacion() * $this->getInfracciones()) ;
        return $coeficiente;
    }

    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena = $cadena. "Infracciones: ".$this->getInfracciones()."\n";
        return $cadena;
    }
}