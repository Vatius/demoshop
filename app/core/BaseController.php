<?php

namespace app\core;

class BaseController {

    public $layout = '';

    public function __construct($layout = 'main')
    {
        $this->layout = $layout;
    }

    public function redirect($path) {
        header('location: '.$path);
        die();
    }

    public function render($view, $data = []) {
        //some here
        $classname = str_replace("app\controllers\","",static::class); 
        $classname = str_replace("Controller","",$classname);
        $classname = strtolower($classname);
        echo $this->renderPhpFile(APP_DIR.DS.'views'.DS.'layout'.DS.$this->layout.'.php', [
            'content' => $this->renderPhpFile(APP_DIR.DS.'views'.DS.$classname.DS.$view.'.php',$data),
        ]);
    }

    public function renderPhpFile($_file_, $_params_ = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        try {
            require $_file_;
            return ob_get_clean();
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }

}
