<?php

namespace lambdaFramework\includes\php\database;

interface IDataBase {

    function conectar(): void;

    function desconectar(): void;

    function ejecutar(): bool;

    function consultar(): bool|array;

    function cargarObjeto(): bool|array;
}
