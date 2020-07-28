<?php
spl_autoload_register("auto_loader");
function auto_loader($class_name){
    $path = "/www/wwwroot/api.sunxiaochuan258.com/ChatAccounting/classes/";
    $ext = ".class.php";
    $full_path = $path . $class_name . $ext;
    include_once $full_path;
}