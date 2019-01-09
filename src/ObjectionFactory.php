<?php

namespace Incraigulous\Objection;


/**
 * Class Objection
 */
class ObjectionFactory
{
    public static function make(array $array, $dataKey = null)
    {
        $data = ($dataKey && isset($array[$dataKey])) ? $array[$dataKey] : $array;

        if (!$data) {
            return null;
        }

        return (static::isAssoc($data)) ? new DataTransferObject($array, $dataKey) : new Collection($array, $dataKey);
    }

    protected static function isAssoc($arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
