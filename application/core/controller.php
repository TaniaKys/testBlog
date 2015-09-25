<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author Tanya
 */
class Controller {
    protected $model;
    protected $view;

    public function __construct() {
        require_once 'application/models/model_dao.php';
        $this->model = new Model_DAO();
        $this->view = new View();
    }

    public function actionIndex($arg) {
         
    }
}
