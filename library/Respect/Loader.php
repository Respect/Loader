<?php

namespace Respect;

class Loader
{
    public function findFileFromClassName($className)
    {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $fileName = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';
        
        if ($fileName = stream_resolve_include_path($fileName))
            return $fileName;

    }
    
    public function __invoke($className) 
    {
        require $this->findFileFromClassName($className);
    }
}

if (!defined('RESPECT_DO_NOT_RETURN_AUTOLOADER'))
    return new Loader;
