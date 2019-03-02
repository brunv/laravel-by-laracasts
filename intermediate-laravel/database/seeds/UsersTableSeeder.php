<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Mass assignment protection is automatically disabled during database seeding. */

        // factory(App\User::class, 50)->create();
        // factory('App\User' , 50)->create();
        // o método ->make() criar mas não persiste os dados, o que é bom para testes
        
        // reescrevendo as definições que estão no modelo de factory
        factory(App\User::class, 50)->create([
            'name' => 'John Doe'
        ]);

        // Laravel sabe o que deve ser criado (ex: um nome ou e-mail) pela classe que define
        // uma factory (ex UserFactory.php)
    }
}
