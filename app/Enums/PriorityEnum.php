<?php

namespace App\Enums;

enum PriorityEnum :int
{
    case Low = 1;
    case MEDIUM = 2;
    case HIGH = 3;
    case CRITICAL = 4;

    public function toString(): string
    {
        return ucwords(strtolower($this->name));
    }
}
