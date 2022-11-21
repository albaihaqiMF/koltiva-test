<?php

namespace App\Helpers;

class Helpers
{
    public static function storeFile($attr, $folder = 'files', $option = 'public')
    {
        $extension = $attr->extension();
        $path = $attr->storeAs($folder, date('dmyhis') . '.' . $extension, $option);

        return $path;
    }
}
