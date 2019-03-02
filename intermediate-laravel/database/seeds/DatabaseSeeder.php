<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'lessons'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // toda vez que seed for chamada, a tabela será reiniciada:
        // foreach ($this->$toTruncate as $table) {
        //     DB::table($table)->truncate();
        // }
        DB::table('users')->truncate();
        DB::table('lessons')->truncate();


        $this->call(UsersTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
    }
}
