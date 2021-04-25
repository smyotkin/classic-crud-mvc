<?php
    namespace App\Controller;

    use \Core\Controller\Controller as Controller;
    use \App\Model\Clients as ClientsModel;
    use \Rakit\Validation\Validator as Validator;

    class Clients extends Controller
    {
        public $data = [];

        public function Add()
        {
            $model = new ClientsModel();

            if (isset($_POST['submit'])) {
                $validator = new Validator;

                $validation = $validator->validate($_POST, [
                    'name'  => 'required|regex:/^[\s\d\pL\pM]+$/u',
                    'phone' => 'required|digits_between:10,12',
                    'email' => 'required|email',
                ]);

                $this->data['validated'] = $validation->getValidatedData();

                if ($validation->fails()) {
                    $this->data['errors'] = $validation->errors()->all(':message');
                } else {
                    $this->data['success'] = $model->addNew($validation->getValidData());
                    $this->data['errors']  = !$this->data['success'] ? ['This entry exist'] : null;
                }
            }
            
            $this->renderTemplate(THEME_PATH . '/Page/Clients/Add', $this->data);
        }

        public function Show()
        {
            $model = new ClientsModel();

            $validator = new Validator;

            $validation = $validator->validate($_GET, [
                'name'   => $validator('in', ['asc', 'desc']), 
                'phone'  => $validator('in', ['asc', 'desc']),
                'email'  => $validator('in', ['asc', 'desc']),
                'filter' => 'regex:/^[\s\d\pL\pM]+$/u',
            ]);

            $this->data['validated']    = $validation->getValidatedData();
            $this->data['valid']        = $validation->getValidData();
            $this->data['clients']      = $model->getAll($this->data['valid']);
            $this->data['stores_count'] = $model->getCount();

            $this->renderTemplate(THEME_PATH . '/Page/Clients/Show', $this->data);
        }

        public function Delete()
        {
            $model  = new ClientsModel();
            $result = [];
            $code   = 500;
            
            if (isset($_POST['id'])) {
                $validator = new Validator;

                $validation = $validator->validate($_POST, [
                    'id'  => 'integer|min:1',
                ]);

                if ($validation->fails()) {
                    $result = $validation->errors()->toArray();
                } else {
                    $delete = $model->deleteClient($validation->getValidData());

                    if ($delete) {
                        $result = $validation->getValidData();
                        $code   = 200;
                    } else {
                        $result = ['error' => 'Element not exist'];
                    }
                }
            } else {
                $result = ['error' => 'Empty param Id'];
            }

            \Flight::json($result, $code);
        }
    }
