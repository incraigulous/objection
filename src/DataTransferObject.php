<?php

namespace Incraigulous\Objection;

use SchulzeFelix\DataTransferObject\DataTransferObject as Base;
use Tightenco\Collect\Contracts\Support\Arrayable;

class DataTransferObject extends Base
{
    use Collects;

    public function __construct(array $attributes = [], $dataKey = '')
    {
        $attributes = $this->toObject($attributes, $dataKey);
        $this->fill($attributes);
    }

    /**
     * Get the attributes that should be converted to dates.
     *
     * @return array
     */
    public function getDates()
    {
        return $this->dates;
    }
}
