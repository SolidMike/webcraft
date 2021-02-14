<?php


namespace app\core;


class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }


    public function render($title, $vars = []) {
        $path = 'app/view/' . $this->path . '.php';
        extract($vars);
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'app/view/layouts/' . $this->layout . '.php';

        } else {
            echo 'Вид не найден' . $this->path;
        }
    }

    public static function errorCode($code) {
        http_response_code($code);
        $path = 'app/view/errors/' . $code . '.php';
        if (file_exists($path)) {
            require $path;
        }

        exit;
    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }
}