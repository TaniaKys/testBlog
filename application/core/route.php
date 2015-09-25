<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of route
 *
 * @author Tanya
 */
class Route {

    static function start() {
        $controller_name = 'main';
        $arg = false;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        // get controller name
        if (!empty($routes[2])) {
            $controller_name = $routes[2];
        }

        // get arg
        if (!empty($routes[3])) {
            if ($controller_name == "post") {
                if (!empty($routes[4])) {
                    Route::ErrorPage404();
                } else {
                    $arg = $routes[3];
                }
            } else {
                Route::ErrorPage404();
            }
        }



        $controller_name = 'Controller_' . $controller_name;

        //  include controller file
        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "application/controllers/" . $controller_file;
        if (file_exists($controller_path)) {
            include "application/controllers/" . $controller_file;
        } else {
            Route::ErrorPage404();
        }

        // create a controller
        $controller = new $controller_name;
        $controller->actionIndex($arg);
    }

    function ErrorPage404() {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }

}
?>


