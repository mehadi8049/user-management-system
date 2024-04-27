<?php

if (! function_exists('sayhello')) {
    function url($path)
    {
        return $path;
    }
}

if (! function_exists('redirect')) {
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}

if (! function_exists('back')) {
    function back()
    {
        $previous='/';
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        header('Location: ' . $previous, true, 303);
        die();
    }
}

if (! function_exists('env')) {
    function env($key)
    {
        return $_ENV[$key];
    }
}

if (! function_exists('toObject')) {
    function toObject($data,$multiple=false) {
        if(count($data)==1 && !$multiple){
           $data=$data[0];
        }
        $object = new stdClass();
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = ToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}

if (! function_exists('user')) {
    function user()
    {
        session_start();
        return $_SESSION['auth_user'];
    }
}