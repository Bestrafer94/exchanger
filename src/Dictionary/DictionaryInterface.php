<?php

namespace App\Dictionary;

interface DictionaryInterface
{
    public static function getNamesMapping(): array;

    public static function getNames(): array;

    public static function getKeys(): array;
}
