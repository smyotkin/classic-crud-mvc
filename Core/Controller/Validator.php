<?php
    namespace Core\Controller;

    class Validator
    {
        public static function class($class) {
            return !empty($class) ? ucfirst(htmlspecialchars($class)) : false;
        }

        public static function method($method) {
            return !empty($method) ? htmlspecialchars($method) : false;
        }
    }