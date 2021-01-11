<?php

namespace JulianStark999\LaravelModelIid\Exceptions;

use Exception;

class SchemaDoesNotHasIidColumnException extends Exception
{
    public static function create(string $tableName)
    {
        return new static("The `iid` column was not found in `{$tableName}` table.");
    }
}
