<?php 

require('conexion.php');

if ($argc < 2) {
    die("Uso: php load_data.php archivo.csv\n");
}

$archivo_csv = $argv[1];

if (!file_exists($archivo_csv)) {
    die("Error: El archivo no existe.\n");
}

$lineas = file($archivo_csv);

$i = 0;
$cantidad_registros = count($lineas);
$cantidad_regist_agregados = $cantidad_registros - 1; 

foreach ($lineas as $linea) {
    
    if ($i != 0) {
        
        $datos = explode(";", $linea);
       
        $nombre  = !empty($datos[0]) ? trim($datos[0]) : '';
        $usuario = !empty($datos[1]) ? trim($datos[1]) : '';
        $correo  = !empty($datos[2]) ? trim($datos[2]) : '';
        $edad    = !empty($datos[3]) ? (int)$datos[3] : 0; 

        $insertar = "INSERT INTO clientes (nombre, usuario, correo, edad) 
                     VALUES ('$nombre', '$usuario', '$correo', $edad)";
        if ($conexion->query($insertar) === TRUE) {
            echo "Registro $i insertado correctamente: $nombre, $usuario, $correo, $edad\n";
        } else {
            echo "Error al insertar el registro $i: " . $conexion->error . "\n";
        }
    }
    $i++;
}

echo "Total de registros procesados: $cantidad_regist_agregados\n";

?>


