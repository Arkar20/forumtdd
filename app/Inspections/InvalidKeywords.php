<?php
namespace App\Inspections;

use Exception;

class InvalidKeywords
{
    protected $detectInvalidKeywords = ['nnn'];

    public function detect($body)
    {
        foreach ($this->detectInvalidKeywords as $span) {
            if (strpos($body, $span) !== false) {
                throw new Exception('found Span keywords');
            }
        }
    }
}
