<?php

class Page {
    
    private $data;
    
    public function __construct() {
        $this->data = array();
        return;
    }
    
    public function display($page) {
        $this->render($page, $this->data);
    }

    /**
     * void
     * render($file, $data = array())
     *
     * Renders specified file, extracting given data, if any.
     */
    private function render($page, $data = array())
    {
        $pagePath = dirname(__FILE__) . "/../templates/$page.tpl.php";
        if (!preg_match("/\.\./", $page) && file_exists($pagePath))
        {
            extract($data);
            require(dirname(__FILE__) . "/../templates/header.tpl.php");
            require($pagePath);
            require(dirname(__FILE__) . "/../templates/footer.tpl.php");
        } else {
            echo "$page not found!";
        }
    }
    
    public function set($key, $value) {
        $this->data[$key] = $value;
        return true;
    }
    public function setAll($keyVals) {
        if(is_array($keyVals)) {
            $this->data = array_merge($this->data, $keyVals);
            return true;
        }
        return false;
    }
    public function get($key) {
        return (isset($this->data[$key])) ? $this->data[$key] : null;
    }
    public function remove($key) {
        unset($this->data[$key]);
        return true;
    }
    public function clearData() {
        $this->data = array();
        return true;
    }
}

?>