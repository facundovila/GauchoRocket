<?php

require_once 'BaseController.php';

class ReservarController extends BaseController {
    private ReservarModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {

    }
}