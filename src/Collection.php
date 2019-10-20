<?php

namespace Incraigulous\Objection;

use Illuminate\Support\Collection as Base;

class Collection extends Base
{
    use Collects;

    /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */
    public function __construct($items = [], $dataKey = '')
    {
        $items = $this->toObject($items, $dataKey);
        parent::__construct($items);
    }
}
