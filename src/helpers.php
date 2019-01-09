<?php

if (! function_exists('objection')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array  $array
     * @return array
     */
    function objection(array $array, $dataKey = null)
    {
        return \Incraigulous\Objection\ObjectionFactory::make($array, $dataKey);
    }
}
