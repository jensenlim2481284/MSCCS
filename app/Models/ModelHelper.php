<?php

namespace App\Models;

trait ModelHelper
{


    # Funtion to get Model by uid 
    public static function whereUID($uid)
    {        
        $result = self::where('uid', $uid)->first();
        return ($result)?$result:null;
    }


    # Funtion to get column JSON key  
    public function getJSON($column = 'meta', $key = null, $isArray = false)
    {
        
        $json = json_decode($this->{$column}, $isArray );
        if ($key) return isset($json->{$key}) ? $json->{$key} : null;
        return $json ?? (object)[];
    }


    # Funtion to get Model meta 
    public function getMeta($key = null)
    {
        return $this->getJSON('meta', $key);
    }

    # Funtion to update Model meta 
    public function updateMeta($key, $value)
    {
        $meta = $this->getMeta();
        $meta->{$key} = $value;
        $this->update(['meta' => json_encode($meta)]);
    }


}
