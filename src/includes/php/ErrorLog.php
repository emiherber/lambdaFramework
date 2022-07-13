<?php
namespace lambdaFramework\includes\php;

use Exception;

abstract class ErrorLog {

    static function log(string $nombreArchivo, string $texto, string $sql = '', array $valores = [], Exception $exception = null) {
        $file = fopen(__DR__ . "/lamlogs/" . $nombreArchivo . date("YmdHis") . ".lmdsi", "a");
        //contenido
        fputs($file, "Error: ");
        fputs($file, $texto . "\r\n");
        fputs($file, "Fecha y hora:" . date('d/m/Y H:i:s') . "\r\n");
        //opcionales
        if ($sql != '') {
            fputs($file, "\r\nConsulta:" . $sql . "\r\n");
        }

        if (is_array($valores) && count($valores) > 0) {
            ob_start();
            var_dump($valores);
            fputs($file, "\r\nValores:" . ob_get_contents() . "\r\n");
            ob_end_clean();
        }

        if ($exception instanceof Exception) {
            fputs($file, "\r\nException: (" . $exception->getCode() . ") " . $exception->getMessage() . "\r\ntrace:\r\n" . $exception->getTraceAsString() . "\r\n");
        }

        fclose($file);
    }

}
