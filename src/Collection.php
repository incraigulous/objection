<?php

namespace Incraigulous\Objection;

use Illuminate\Support\Collection as Base;
use Illuminate\Contracts\Support\Arrayable;

class Collection extends Base implements Arrayable
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
