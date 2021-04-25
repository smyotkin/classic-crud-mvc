<?php
    namespace Core\Controller;

    use Core\Controller\Validator as Validate;
    use Valitron\Validator as v;

    
    class Controller
    {
         //  as Validator

        public function loadMethod($className, $method, $slug = null)
        {
            $className = CONTROLLER_DIR . Validate::class($className);
            $method    = Validate::method($method);

            if (class_exists($className)) {
                if (method_exists($class = new $className(), $method)) {
                    !empty($slug) ? $class->$method($slug) : $class->$method();
                } else {
                    return true;
                }
            } else {
                $this->setError(3);
            }
        }

        public function setError(int $code = 0, $msg = null)
        {
            $error    = !empty(ERRORS[$code]) ? ERRORS[$code] : ERRORS[0];
            $response = [
                'error' => [
                    'code' => $code,
                    'msg'  => !empty($msg) ? $msg : $error
                ]
            ];

            \Flight::json($response, $code = 500, $encode = true, $charset = 'utf-8', $option = JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);

            exit();
        }

        public static function renderTemplate($template, $args = [])
        {
            static $twig = null;
    
            if ($twig === null) {
                $loader = new \Twig\Loader\Filesystemloader(VIEW_DIR);
                $twig   = new \Twig\Environment($loader, [
                    'debug' => true
                ]);

                $twig->addExtension(new \Twig\Extension\DebugExtension());

                $function = new \Twig\TwigFunction('shuffle', function ($array) {
                    shuffle($array);
                    return $array;
                });

                $twig->addFunction($function);

                $filter = new \Twig\TwigFilter('stripslashes', 'stripslashes');
                
                $twig->addFilter($filter);
            }

            echo $twig->render($template . '.twig', $args);
        }

        // public function validateParams($array, $availableParams, $default = null)
        // {
        //     $v = new v($array);
        //     $v->mapFieldsRules($availableParams);
    
        //     $result = [
        //         'validated' => true,
        //         'all'       => [], 
        //         'valid'     => []
        //     ];

        //     $valid = $v->validate();

        //     $errors = $v->errors();
        //     !empty($errors) ? $result['errors'] = $errors : null;

        //     foreach ($availableParams as $param => $rule) {
        //         if (!$valid && in_array('required', $rule) && isset($errors[$param]))
        //             $result['valid'] = false;
                
        //         if (isset($array[$param]) && $array[$param] != '' && !isset($errors[$param])) {
        //             $result['all'][$param] = $array[$param];
        //         } elseif (isset($default[$param])) {
        //             $result['all'][$param] = $default[$param];
        //             $result['notice'][$param][] = ucfirst($param) . " is invalid or missing, set to default ({$default[$param]})";
        //         } else {
        //             $result['all'][$param] = null;
        //         }
        //     }

        //     $result['valid'] = array_filter($result['all'], 'strlen');

        //     return $result;
        // }
    }
