<?php

/**
 * Class Error
 * This controller simply shows a page that will be displayed when a controller/method is not found. Simple 404.
 */
class ErrorController extends Controller {
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct() {
        //@todo add without header and foter to make sure that normal users dont see ui. 
        parent::__construct();
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens / what the user sees when a page does not exist (404)
     */
    public function index() {
        header('HTTP/1.0 404 Not Found');
        $this->View->render('error/index');
    }
}
