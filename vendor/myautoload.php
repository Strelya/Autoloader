<?php

class MyAutoloaderClass
{

protected $prefixes = array();

public function register()
{
spl_autoload_register(array($this, 'loadClass'));
}

public function getNamespace($prefix, $base_dir, $prepend = false)
{
$prefix = trim($prefix, '\\') . '\\';

$base_dir = rtrim($base_dir, DIRECTORY_SEPARATOR) . '/';

if (isset($this->prefixes[$prefix]) === false) {
$this->prefixes[$prefix] = array();
}

if ($prepend) {
array_unshift($this->prefixes[$prefix], $base_dir);
} else {
array_push($this->prefixes[$prefix], $base_dir);
}
}

public function loadClass($class)
{
$prefix = $class;

// work backwards through the namespace names of the fully-qualified
// class name to find a mapped file name
while (false !== $pos = strrpos($prefix, '\\')) {

// retain the trailing namespace separator in the prefix
$prefix = substr($class, 0, $pos + 1);

// the rest is the relative class name
$relative_class = substr($class, $pos + 1);

// try to load a mapped file for the prefix and relative class
$mapped_file = $this->loadMappedFile($prefix, $relative_class);
if ($mapped_file) {
return $mapped_file;
}

// remove the trailing namespace separator for the next iteration
// of strrpos()
$prefix = rtrim($prefix, '\\');
}

// never found a mapped file
return false;
}

/**
* Load the mapped file for a namespace prefix and relative class.
*
* @param string $prefix The namespace prefix.
* @param string $relative_class The relative class name.
* @return mixed Boolean false if no mapped file can be loaded, or the
* name of the mapped file that was loaded.
*/
protected function loadMappedFile($prefix, $relative_class)
{
// are there any base directories for this namespace prefix?
if (isset($this->prefixes[$prefix]) === false) {
return false;
}

// look through base directories for this namespace prefix
foreach ($this->prefixes[$prefix] as $base_dir) {

// replace the namespace prefix with the base directory,
// replace namespace separators with directory separators
// in the relative class name, append with .php
$file = $base_dir
. str_replace('\\', '/', $relative_class)
. '.php';

// if the mapped file exists, require it
if ($this->requireFile($file)) {
// yes, we're done
return $file;
}
}

// never found it
return false;
}

/**
* If a file exists, require it from the file system.
*
* @param string $file The file to require.
* @return bool True if the file exists, false if not.
*/
protected function requireFile($file)
{
if (file_exists($file)) {
require $file;
return true;
}
return false;
}
}

$autoloader = new MyAutoloaderClass();
$autoloader->getNamespace(
    'App/', '../src/'
);
$autoloader->register();