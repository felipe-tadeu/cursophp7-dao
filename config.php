<?php

/** AUTOLOAD REGISTER */
spl_autoload_register(function($class_name) {

    /** FILE NAME */
    $file_name = "class" . DIRECTORY_SEPARATOR . $class_name . ".class.php";

    /** REQUIRE */
    if (file_exists($file_name)) {
        require_once($file_name);
    }

})

?>