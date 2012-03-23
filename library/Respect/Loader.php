<?php

namespace Respect;

class Loader
{
    public function __invoke($className) 
    {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $fileName = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';
        
        if (stream_resolve_include_path($fileName))
            require $fileName;
    }
}

if (!defined('RESPECT_DO_NOT_RETURN_AUTOLOADER'))
    return new Loader;
