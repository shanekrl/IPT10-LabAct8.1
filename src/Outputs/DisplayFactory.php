<?php

namespace App\Outputs;

use App\Outputs\HTMLFormat;
use App\Outputs\PDFFormat;
use App\Outputs\TextFormat;

class DisplayFactory
{
    public static function getInstance($format = 'text')
    {
        if ($format == 'text') {
            return new TextFormat();
        } elseif ($format == 'html') {
            return new HTMLFormat();
        } elseif ($format == 'pdf') {
            return new PDFFormat();
        }
        
        // else
        return null;
    }
}
