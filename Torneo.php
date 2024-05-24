<?php

class Torneo{
    private $colPartidos;
    private $importePremio;

    public function __construct($colPartidos, $importePremio){
        $this->colPartidos = []; // Inicializa como un arreglo vacío
        $this->importePremio = $importePremio;

    }
    public function setColPartidos($colPartidos){
        $this->colPartidos = $colPartidos;
    }

    public function getColPartidos(){
        return $this->colPartidos;
    }

    public function setImportePremio($importePremio){
        $this->importePremio = $importePremio;
    }

    public function getImportePremio(){
        return $this->importePremio;
    }

    public function coleccionATexto($coleccion) {
        $texto = "";
        foreach ($coleccion as $obj) {
            $texto .= $obj. "\n";
        }
        return $texto;
    }

    /* método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) */
     public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) {
        $objPartido = null;
        if ($OBJEquipo1->getObjCategoria() === $OBJEquipo2->getObjCategoria() && $OBJEquipo1->getCantJugadores() === $OBJEquipo2->getCantJugadores()) {
            $idPartido = count($this->colPartidos) + 1;
            $cantGolesE1 = 0; 
            $cantGolesE2 = 0;
            $coefBase = 0.5;

            if ($tipoPartido === "futbol"  ) {
                $objPartido = new PartidoFutbol($idPartido, $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2, $coefBase);
                $this->colPartidos[] = $objPartido;
            } elseif ($tipoPartido === "basquet") {
                $infracciones = 0; 
                $objPartido = new PartidoBasquet($idPartido, $fecha, $OBJEquipo1, $cantGolesE1, $OBJEquipo2, $cantGolesE2, $coefBase, $infracciones);
                $this->colPartidos[] = $objPartido;
            }
        }
        return $objPartido;
    }

    /* metodo darGanadores($deporte) 
    recibe por parámetro si se
trata de un partido de fútbol o de básquetbol y en base al parámetro busca entre esos partidos los
equipos ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los
objetos de los equipos encontrados*/
  public function darGanadores($deporte){
$ganadores = [];
foreach($this->getColPartidos() as $partido){
 if($partido instanceof PartidoFutbol && $deporte === "futbol"){
    $ganadores[] = $partido->darEquipoGanador();

 }
 elseif($partido instanceof PartidoBasquet && $deporte === "Basquet"){
    $ganadores[] = $partido->darEquipoGanador();

 }
}
return $ganadores; 
}
public function calcularPremioPartido($OBJPartido) {
    $resultado = [];
    $equipoGanador = $OBJPartido->darEquipoGanador();
    $coeficientePartido = $OBJPartido->coeficientePartido();
    $premioPartido = $coeficientePartido * $this->getImportePremio();

    $resultado['equipoGanador'] = $equipoGanador;
    $resultado['premioPartido'] = $premioPartido;

    return $resultado;
}

/* método calcularPremioPartido($OBJPartido) */

     /* metodo toString */
     public function __toString()
     {
         $cadena = "";
         $cadena .= "\n ".$this->coleccionATexto($this->getColPartidos())."\n";
         $cadena .= "\n ".$this->getImportePremio()."\n";
         return $cadena;
     }
}
   

