<?php

abstract class BaseModel {
    protected MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }
}
