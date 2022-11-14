<?php
include './funciones.php';
const PRECIO_BASE = 200;
// $precio va a ser el precio del seguro final!!
$precio = PRECIO_BASE;
//Vamos a usar la variable $poliza para almacenar los conceptos
$poliza["BASE"]=PRECIO_BASE;
var_dump($poliza);



// PRECIO BASE : 200
//-- según el tomador
//con menos de 10 años de carnet BASE x 2
$añoCarnet = $_POST['añoCarnet'];
if (date("Y") - $añoCarnet < 10) { //date("Y") nos da el año del sistema
    $poliza["Menos de 10 años de carnet"] = $precio;
    $precio *= 2;
}

//si es mujer 10% dcto.
$sexo = $_POST['sexo'];
if ($sexo == "M") {
    //Calculamos el descuento de mujer
    $poliza["Buena conductora"] = $precio*(-0.1);
    $precio = $precio * 0.9;
}

//-- según el vehículo
//con más de 10 años de matriculación suplemento de 100€
$añoMatricula = $_POST["añoMatricula"];
if (date("Y") - $añoMatricula > 10) {
    $poliza["Vehiculo antiguo"] = 100;
    $precio = $precio + 100;
}

//eléctrico rebaja del 30%
//diesel suplemento del 30%
$tipoCombustible = $_POST["tipoCombustible"];

if ($tipoCombustible == "electrico") {
    $poliza["Vehículo ecológico"] = $precio *(-0.30);
    $precio = $precio * 0.70;
} elseif ($tipoCombustible == "diesel") {
    $poliza ["Vehículo contaminante"] = $precio * 0.30;
    $precio = $precio * 1.30;
}


  //-- según modalidad
  //'B'asico -> no cambia
  //'I'ntermedio -> suplemento 200€
  //'T'odo riesgo -> precio x 2
 $modalidad= $_POST["tipoSeguro"];
 
 switch ($modalidad) {
    case 'I':
        $poliza["Modalidad intermedia"] = 200;
        $precio = $precio + 200;
         break;
    case 'T':
        $poliza["Modalidad todo riesgo"] = $precio;
        $precio = $precio * 2;
         break;
    default:
        break;
}
//para guardar la variable del nombre 
$nombre = $_POST["nombre"];
$matricula = $_POST["matricula"];
echo "$nombre el seguro para tu vehículo $matricula vale $precio €.";

echo generaTabla($poliza, true, ['Concepto', 'Importe', 'Suma']);
?>
<br>
<button onclick="history.back()">otro seguro</button>





