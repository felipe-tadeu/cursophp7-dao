<?php

/**
 * Função Mágica Autoload Register
*/
spl_autoload_register(function($class_name) {

    /**
     * Nome do diretório das classes
    */
    $file_name = "class" . DIRECTORY_SEPARATOR . $class_name . ".class.php";

    /**
     * Require dos arquivos
    */
    if (file_exists($file_name)) {
        require_once($file_name);
    }

})

?>