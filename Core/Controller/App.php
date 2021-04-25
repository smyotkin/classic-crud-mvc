<?php
    namespace Core\Controller;

    use Core\Controller\Controller as Controller;
    use Core\Model\Database as DB;

    class App extends Controller
    {
        public function init()
        {
            DB::connectEloquent();

            \Flight::route('GET|POST /@class/@method', function($class, $method) {
                return $this->loadMethod($class, $method);
            });

            \Flight::route('GET|POST /', function() {
                return $this->loadMethod('start', 'start');
            });

            \Flight::route('GET|POST *', function() {
                $this->setError(1);
            });

            \Flight::start();
        }
    }