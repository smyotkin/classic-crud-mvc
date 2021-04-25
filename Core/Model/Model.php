<?php
    namespace Core\Model;

    use \Illuminate\Database\Eloquent\Model as Eloquent;
    use Core\Model\Database as DB;

    class Model extends Eloquent
    {
        public static $schema;

        public function __construct()
        {
           self::$schema = DB::$capsule->schema();
        }

        public function getCount()
        {
            return self::query()->select('*')->get()->count();
        }

        public function getSql($query)
        {
            return vsprintf(str_replace(['?'], ['\'%s\''], $query->toSql()), $query->getBindings());
        }

        public function getColumns($table)
        {
            return self::$schema->getColumnListing($table);
        }
    }
