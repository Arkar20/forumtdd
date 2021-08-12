<?php

namespace App\Inspections;

use App\Inspections\KeyHeldDown;
use App\Inspections\InvalidKeywords;

class Span
{
    protected $invalidkeywords = [InvalidKeywords::class, KeyHeldDown::class];
    public function detect($body)
    {
        foreach ($this->invalidkeywords as $keyword) {
            app($keyword)->detect($body);
        }

        return false;
    }
}
