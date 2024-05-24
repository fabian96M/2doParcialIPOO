<?php
class PartidoFutbol extends Partido{

   
    public function __construct($idPartido, $fecha, $objEquipo1,$cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase)
    {
        parent::__construct($idPartido, $fecha, $objEquipo1,$cantGolesE1, $objEquipo2, $cantGolesE2, $coefBase);
        
    }


    /* METODO coeficientPartido() */
    public function coeficientePartido()
    {
        /* Se asume que ambos equipos son de una misma categoria */
        $objCategoria =parent::getObjEquipo1()->getObjCategoria();
        $categoria = $objCategoria->getidcategoria();
        if($categoria === "Menores"){
            parent::setCoefBase(0.13);

        }
        elseif($categoria === "Juveniles"){
            parent::setCoefBase(0.19);
        }
        elseif($categoria === "Mayores"){
            parent::setCoefBase(0.27);
        }
        /* verificamos que categoria de partido es */
        $coeficiente = parent::coeficientePartido();
        return $coeficiente;

    }

    public function __toString()
    {
        $cadena = parent::__toString();
        return $cadena;
    }
}