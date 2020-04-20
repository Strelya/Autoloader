<?php

function my_autoload ($ClassName) {
    require_once '../src/' . $ClassName . ".php";
}
spl_autoload_register("my_autoload");


//class MyAutoloaderClass
//{
//    private $prefix;
//    private $base_dir;
//
//    public function __construct($prefix, $base_dir)
//    {
//        $this->loadClass($prefix, $base_dir);
//    }
//
//    public function loadClass($class, $dir)
//    {
////        include $dir . $class . '.php';
//        return $dir . $class . '.php';
//
//    }
//
////    public function register()
////    {
////    spl_autoload_register( 'loadClass');
////    }
//
//}
//
//$autoloader = new MyAutoloaderClass('Currency', '../src/');
////$autoloader->register();