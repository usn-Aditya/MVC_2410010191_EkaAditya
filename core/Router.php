<?php

class Router {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();

        // 1. Cek apakah file controller yang diminta ada
        if (!empty($url[0])) {
            $requestedController = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $requestedController . '.php')) {
                $this->controller = $requestedController;
                unset($url[0]);
            } else {
                // Jika controller tidak ditemukan, tampilkan error 404
                $this->error404();
                return;
            }
        }

        // Require file controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Cek apakah method yang diminta ada di dalam controller tersebut
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->error404();
                return;
            }
        }

        // 3. Kelola parameter jika ada
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan controller & method serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }

    private function error404() {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>Halaman atau Controller yang Anda cari tidak ditemukan.</p>";
        exit;
    }
}
