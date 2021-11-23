<?php

class QRGenerator {
    private string $size;
    private string $encoding;

    public function __construct(string $size = "400", string $encoding = "UTF-8") {
        $this->size = $size;
        $this->encoding = $encoding;
    }

    public function getQRUrl($code) {
        return "https://chart.googleapis.com/chart?"
        ."chs=" .$this->size ."x" .$this->size
        ."&cht=qr"
        ."&chl=" .$code
        ."&choe=UTF-8";
    }
}