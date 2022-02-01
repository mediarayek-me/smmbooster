<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!app()->runningUnitTests())
        {
            $sql = file_get_contents(base_path('database'.DIRECTORY_SEPARATOR .'init'.DIRECTORY_SEPARATOR.'init.sql'));
            DB::unprepared($sql);
        }

    }
}
