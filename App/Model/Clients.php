<?php
    namespace App\Model;

    use Core\Model\Model;

    class Clients extends Model
    {
        protected $table      = DB_PREFIX . 'clients';
        public    $timestamps = false;
        protected $fillable   = ['name', 'phone', 'email'];

        public function getAll($valid)
        {
            $query = self::query();
            $sort  = [];

            foreach ($valid as $key => $parameter) {
                if ($key != 'filter' && $parameter) {
                    $sort['column'] = $key;
                    $sort['sort']   = $parameter;

                    break;
                }
            }
            
            $query->select('*');

            if ($valid['filter']) {
                $query->where('name', 'like', '%' . $valid['filter'] . '%')
                ->orWhere('phone', 'like', '%' . $valid['filter'] . '%')
                ->orWhere('email', 'like', '%' . $valid['filter'] . '%');
            }

            $query->orderBy($sort['column'] ?? 'id', $sort['sort'] ?? 'asc');

            return $query->get()->toArray();
        }

        public function addNew($data)
        {
            $query = self::query();
            $user  = $query->where('email', $data['email'])->first();

            return !$user ? $query->insert($data) : false;
        }

        public function deleteClient($data)
        {
            $query = self::query();
            $exist = $query->where('id', $data['id'])->first();

            return $exist ? $query->where('id', $data['id'])->delete() : false;
        }
    }
