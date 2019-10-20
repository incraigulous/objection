<?php
/**
 * Created by PhpStorm.
 * User: craigw
 * Date: 5/31/17
 * Time: 11:41 AM
 */

namespace Incraigulous\Objection;


trait Collects
{
    protected $_original;

    protected function toObject($data, $dataKey = null)
    {
        $result = [];
        $this->_original = $data;
        $data = $this->unKey($data, $dataKey);
        foreach($data as $key => $record) {
            if (!is_array($this->unKey($record, $dataKey))) {
                $result[$key] = $record;
            } elseif ($this->isAssoc($this->unKey($record, $dataKey))) {
                $result[$key] = new DataTransferObject($record, $dataKey);
            } else {
                $result[$key] = new Collection($record, $dataKey);
            }
        }
        return $result;
    }

    public function getOriginal()
    {
        return $this->_original;
    }

    protected function isAssoc($arr)
    {
        if ([] === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public function unKey($data, $key) {
        if ($key && isset($data[$key])) {
            $data = $data[$key];
        }
        return $data;
    }
}
