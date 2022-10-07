<?php

use Illuminate\Support\Facades\Storage;

if(!function_exists('serializeMetadata')){
    function serializeMetadata($array){
        $data = [];
        foreach ($array as $item){
            $item = trim($item);
            $item = strtolower($item);
            $item = str_replace(' ', '_', $item);
            $data[] = $item;
        }
        return serialize($data);
    }
}

if (!function_exists('unserializeMetadata')){
    function unserializeMetadata($str){
        $array = [];
        foreach (unserialize($str) as $data){
            $d = str_replace('_', ' ', $data);
            $d = ucwords($d);
            $array[] = $d;
        }
        return $array;
    }
}

if (!function_exists('isFileImage')){
    function isFileImage($path){
        if(Storage::exists($path)){
            $mimeType = Storage::mimeType($path);
            return str_contains(strtolower($mimeType),strtolower('image'));
        }
        return false;
    }
}
