<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

function processSort($items, int $parentID = 0)
{
    $result = [];
    if (is_array($items)) {
        $items = collect($items);
    } elseif ($items instanceof Collection) {
        $items = $items;
    }

    $filtered = $items->where('parent_id', $parentID);
    foreach ($filtered as $item) {

        if (is_object($item)) {
            $item->child_cats = processSort($items, $item->id);
        } else {
            $item['child_cats'] = processSort($items, Arr::get($items, 'id'));
        }
        $result[] = $item;
    }
    
    return $result;
}