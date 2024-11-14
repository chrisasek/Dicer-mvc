<?php

namespace App\Classes;

class Loader
{

    public static function script($src, $page_value = null, $page = 'page')
    {
        if ($page_value) {
            echo Input::get($page) == $page_value ? "<script src='{$src}'></script>" : '';
            return;
        }

        echo "<script src='{$src}'></script>";
        return;
    }
}
