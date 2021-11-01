<?php

class MustachePrinter{
    private $mustache;
    private LogginChecker $logginChecker;

    public function __construct($partialsPathLoader, $logginChecker){
        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialsPathLoader )
            ));

        $this->logginChecker = $logginChecker;
    }

    public function render($template , $data = array() ){
        $contentAsString =  file_get_contents($template);
        $data += $this->logginChecker->loginCheck();
        return  $this->mustache->render($contentAsString, $data);
    }
}