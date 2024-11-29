<?php

spl_autoload_register(function ($class){

     $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

     $classParts = explode(DIRECTORY_SEPARATOR, $classPath);

     for ($i = 0; $i < count($classParts) - 1; $i++) {
         $classParts[$i] = strtolower($classParts[$i]);
     }
 
     $classPath = implode(DIRECTORY_SEPARATOR, $classParts);

     $fullPath = __DIR__ . '/../' . $classPath . '.php';

     if (file_exists($fullPath)) {
         require_once $fullPath;
         return;
     }

});