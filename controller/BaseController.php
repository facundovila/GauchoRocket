<?php

abstract class BaseController {
    protected MustachePrinter $printer;

    public function __construct($printer) {
        $this->printer = $printer;
    }

    public abstract function show();
}