<?php
 namespace App\Services;

 class Filter
 {
    public static function handler($items, $query) 
    {
        $items = array_filter($items, function($item) use($query){
            return str_contains($item["nome"], $query);
        });

        return $items;
    }
    
 }