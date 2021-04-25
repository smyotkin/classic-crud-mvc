<?php
    namespace App\Model;

    use Core\Model\Model;

    class Start extends Model
    {
        protected $table = DB_PREFIX . 'clients';

        public function getAll()
        {
            $query = self::query();

            $query->select('*');
            $query->orderBy('id', 'ASC');

            return $query->get()->toArray();
        }

        // public function getOpenedStores($date)
        // {
        //     $query = self::query();
        //     $day   = date('w', $date);
        //     $hour  = date('H', $date);

        //     $query->select('*');
        //     $query->where('day_start', '<=', $day);
        //     $query->where('day_end', '>=', $day);
        //     $query->whereRaw('HOUR(hour_open) <= ' . $hour);
        //     $query->whereRaw('HOUR(hour_close) > ' . $hour);
        //     $query->orderBy('id', 'ASC');

        //     return $query;
        // }

        // public function getClosedStores($ids)
        // {
        //     $query = self::query();

        //     $query->select('*');
        //     $query->whereNotIn('id', $ids);
        //     $query->orderBy('id', 'ASC');

        //     return $query;
        // }
    }
