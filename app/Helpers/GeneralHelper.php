<?php

function get_setting($key)
{
    $setting = \App\Models\Settings::where('key',$key)->first();

    if($setting)
    {
        if($key=='logo'){
            return  asset("storage/{$setting->value}");
        }

        return $setting->value;
    }
}

function update_setting($key,$value)
{
    $setting = \App\Models\Settings::where('key',$key)->first();
    if($setting){
        $setting->value = $value;
        $setting->save();
    }else{
        $setting = new \App\Models\Settings();
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();
    }
}