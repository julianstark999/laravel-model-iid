<?php

namespace JulianStark999\LaravelModelIid\Exceptions;

use InvalidArgumentException;

class SchemaDoesNotHasIidColumn extends InvalidArgumentException
{
    public static function create(string $tableName)
    {
        return new static("The `iid` column was not found in `{$tableName}` table.");
    }
}
