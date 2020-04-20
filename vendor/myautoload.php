<?php


class MyAutoloaderClass
{

    protected array $prefixes = array();

    public function addNamespace($prefix, $base_dir)
    {

        $array_path = array($prefix => $base_dir);
        array_push($this->prefixes, $array_path);
//        var_dump($this->prefixes);exit;

    }

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function loadClass($class)
    {
        $prefix = $class;
        while (false !== $pos = strrpos($prefix, '\\')) {
            $prefix = substr($class, 0, $pos);
            $relative_class = substr($class, $pos);
            $file = $this->prefixes[0][$prefix]//    Знаю, что костыль, но работает
                    . str_replace('\\', '/', $relative_class)
                    . '.php';

                if (file_exists($file)) {
                   require $file;
                }
        }
    }
}

$autoloader = new MyAutoloaderClass();
$autoloader->addNamespace('App', '../src');
$autoloader->register();