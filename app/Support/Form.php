<?php

namespace App\Support;

class Form
{
    public static function request($value = null, $name = 'token')
    {
        $token = Token::generate();
        $rq = $value ? "<input type='hidden' name='rq' value='{$value}'/>" : '';
        return "<input type='hidden' name='{$name}' value='{$token}'/>" . $rq;
    }

    // Data
    public static function data($data, $bag = "form_data")
    {
        if (Session::exists($bag)) {
            $form = Session::get($bag);
            return isset($form[$data]) ? $form[$data] : null;
        }
    }
    public static function data_save($data, $bag = "form_data")
    {
        Session::put($bag, $data);
    }

    public static function data_remove($bag = "form_data")
    {
        if (Session::exists($bag)) {
            $data = Session::delete($bag);
            return $data;
        }
    }

    public static function filepond($data = null, $bag = "file_upload")
    {
        if (Session::exists($bag)) {
            $file = Session::get($bag);
            if ($data && !in_array($data, $file)) {
                array_push($file, trim($data));
                Session::put($bag, $file);
            }
        } else {
            Session::put($bag, $data);
        }
        return $data;
    }
}
