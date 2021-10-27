<?php

require_once "BaseModel.php";

class ValidatorModel extends BaseModel {
    public function validate($hash) {
        $param = array($hash);
        $query = "UPDATE login SET hash = NULL WHERE hash IS NOT NULL AND hash = ? ";

        return $this->database->query2($param, $query);
    }
}
