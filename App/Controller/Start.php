<?php
    namespace App\Controller;

    use \Core\Controller\Controller as Controller;

    class Start extends Controller
    {
        public $data = [];

        public function Start()
        {
            $this->renderTemplate(THEME_PATH . '/Page/Start/Default', $this->data);
        }
    }
