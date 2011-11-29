<?php
/**
 * __autoload function is automatically called in 
 * case you are trying to use a class/interface 
 * which hasn't been defined yet. 
 */
function __autoload($class) {
    $filename = $class . '.class.php';
    require_once $filename;
}
?>
