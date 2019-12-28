<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //PERMISOS
        DB::table('permisos')->insert([
            'titulo' => 'Administrador',
            'created_at' => now(),
        ]);
        DB::table('permisos')->insert([
            'titulo' => 'Abogado',
            'created_at' => now(),
        ]);
        DB::table('permisos')->insert([
            'titulo' => 'Pasante',
            'created_at' => now(),
        ]);

        //USERS
        DB::table('users')->insert([
            'name' => 'Ley',
            'email'=>'ley@live.com',
            'nombres'=> 'Leyla',
            'apellidos'=> 'Rodriguez',
            'numero'=>'77049140',
            'direccion'=>'c/Ernesto monasterio',
            'ci'=>'845656123',
            'genero'=>'femenino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'1',
            'photo' => 'karen.jpg',
            'created_at' => '2019-10-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'jewSaT3F7FYQ7hxWBFD5NW0C9Sa2',
        ]);
        DB::table('users')->insert([
            'name' => 'Joy',
            'email'=>'joy@live.com',
            'nombres'=> 'Joy',
            'apellidos'=> 'Lopez',
            'numero'=>'60545258',
            'direccion'=>'c/ junin',
            'ci'=>'75454154',
            'genero'=>'femenino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'2',
            'photo' => 'joy.jpg',
            'created_at' => '2019-11-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'xghWAhQvYngp8n5BHB4TfINft2n1',
        ]);
        DB::table('users')->insert([
            'name' => 'Pedro',
            'email'=>'pedro@live.com',
            'nombres'=> 'Pedro',
            'apellidos'=> 'Terrazas',
            'numero'=>'604512551',
            'direccion'=>'c/salvatierra',
            'ci'=>'8445451',
            'genero'=>'masculino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'2',
            'photo' => 'man01.jpg',
            'created_at' => '2019-11-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'Giz6PKW20lQ5I231xb5vyBptuAj2',
        ]);
        DB::table('users')->insert([
            'name' => 'Angela',
            'email'=>'angela@live.com',
            'nombres'=> 'Angela',
            'apellidos'=> 'Torrez',
            'numero'=>'7055156',
            'direccion'=>'c/Ernesto',
            'ci'=>'415665',
            'genero'=>'femenino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'2',
            'photo' => 'wo.jpg',
            'created_at' => '2019-11-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'CTwMd7yN1fe6VySSzLBhpBTAkGz2',
        ]);
        DB::table('users')->insert([
            'name' => 'Jose',
            'email'=>'jose@live.com',
            'nombres'=> 'Jose',
            'apellidos'=> 'Rodriguez',
            'numero'=>'7754665',
            'direccion'=>'c/monasterio',
            'ci'=>'45451451',
            'genero'=>'masculino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'3',
            'photo' => 'jose.jpg',
            'created_at' => '2019-11-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'rIBCvw953fX5ckGjRZ6vLJeklv02',
        ]);
        DB::table('users')->insert([
            'name' => 'Alejandra',
            'email'=>'ale@live.com',
            'nombres'=> 'Alejandra',
            'apellidos'=> 'Murillo',
            'numero'=>'44125125',
            'direccion'=>'c/las palmas',
            'ci'=>'74566556',
            'genero'=>'femenino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'3',
            'photo' => 'alejandra.png',
            'created_at' => '2019-11-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => '1lE6gdWsw3byfTSbw2M55iTvw1s1',
        ]);
        DB::table('users')->insert([
            'name' => 'Mario',
            'email'=>'mario@live.com',
            'nombres'=> 'Mario',
            'apellidos'=> 'Sanchez',
            'numero'=>'65125656',
            'direccion'=>'c/Ernesto monasterio',
            'ci'=>'54561220',
            'genero'=>'masculino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'3',
            'photo' => 'man03.jpg',
            'created_at' => '2019-12-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => 'Oes2NLMwslWJ3Agp7A3Uqp5D7oJ3',
        ]);
        DB::table('users')->insert([
            'name' => 'liz',
            'email'=>'liz@live.com',
            'nombres'=> 'Liz',
            'apellidos'=> 'Llanos',
            'numero'=>'77048460',
            'direccion'=>'c/Ernesto monasterio',
            'ci'=>'151564',
            'genero'=>'femenino',
            'password'=> bcrypt('123123'),
            'permiso_id'=>'3',
            'photo' => 'liz.png',
            'created_at' => '2019-12-01 00:00:00',
            'updated_at' => now(),
            'tokenFirebase' => '3aSpV7nGaHYmuzh0crryQUSUAbb2',
        ]);

        //PERSONAS
        DB::table('clientes')->insert([
            'nombres' => 'Pedro',
            'apellidos' => 'Avila',
            'ci' => '8448556',
            'direccion'=>'c/las palmas',
            'genero'=>'masculino',
            'numero'=>'77049140',
            'email'=>'pedro@live.com',
            'updated_at' => now(),
            'created_at' => '2019-10-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Angela',
            'apellidos' => 'Pozo',
            'ci' => '894565663',
            'direccion'=>'c/ernesto',
            'genero'=>'femenino',
            'numero'=>'6125455',
            'email'=>'angela@live.com',
            'updated_at' => now(),
            'created_at' => '2019-10-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Jose',
            'apellidos' => 'Terceros',
            'ci' => '96516513',
            'direccion'=>'c/junin',
            'genero'=>'masculino',
            'numero'=>'74155152',
            'email'=>'jose@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Alejandra',
            'apellidos' => 'Nogales',
            'ci' => '84516655',
            'direccion'=>'c/manjon',
            'genero'=>'femenino',
            'numero'=>'7555663',
            'email'=>'alejandra@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Mario',
            'apellidos' => 'Gonzales',
            'ci' => '8441112',
            'direccion'=>'c/Dionicio',
            'genero'=>'masculino',
            'numero'=>'66510252',
            'email'=>'mario@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'liz',
            'apellidos' => 'Gutierrez',
            'ci' => '545685452',
            'direccion'=>'c/Simon',
            'genero'=>'femenino',
            'numero'=>'60414518',
            'email'=>'liz@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Camila',
            'apellidos' => 'Quezada',
            'ci' => '8196686',
            'direccion'=>'av. Bush',
            'genero'=>'femenino',
            'numero'=>'77005151',
            'email'=>'camila@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Laura',
            'apellidos' => 'Justiniano',
            'ci' => '10102054',
            'direccion'=>'av. landivar',
            'genero'=>'femenino',
            'numero'=>'7825636',
            'email'=>'laura@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Silvana',
            'apellidos' => 'Melgar',
            'ci' => '89120323',
            'direccion'=>'c/ Heredia',
            'genero'=>'femenino',
            'numero'=>'9823051',
            'email'=>'silvana@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-15 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Jaime',
            'apellidos' => 'Lara',
            'ci' => '465123065',
            'direccion'=>'c/ julio',
            'genero'=>'masculino',
            'numero'=>'8512223',
            'email'=>'jaime@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-20 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Boris',
            'apellidos' => 'Vedia',
            'ci' => '202035',
            'direccion'=>'c/Simon',
            'genero'=>'masculino',
            'numero'=>'60004585',
            'email'=>'boris@live.com',
            'updated_at' => now(),
            'created_at' => '2019-11-21 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Melisa',
            'apellidos' => 'Hurtado',
            'ci' => '895121',
            'direccion'=>'c/Simon',
            'genero'=>'femenino',
            'numero'=>'60056596',
            'email'=>'liz@live.com',
            'updated_at' => now(),
            'created_at' => '2019-12-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Mauricio',
            'apellidos' => 'Santos',
            'ci' => '988555',
            'direccion'=>'c/Simon',
            'genero'=>'masculino',
            'numero'=>'70569925',
            'email'=>'mauricio@live.com',
            'updated_at' => now(),
            'created_at' => '2019-12-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Leni',
            'apellidos' => 'Ricaldi',
            'ci' => '185152102',
            'direccion'=>'c/Simon',
            'genero'=>'femenino',
            'numero'=>'64525542',
            'email'=>'leni@live.com',
            'updated_at' => now(),
            'created_at' => '2019-12-01 00:00:00',

        ]);
        DB::table('clientes')->insert([
            'nombres' => 'Jorge',
            'apellidos' => 'Medrano',
            'ci' => '62564588',
            'direccion'=>'c/Simon',
            'genero'=>'masculino',
            'numero'=>'7006258',
            'email'=>'jorge@live.com',
            'updated_at' => now(),
            'created_at' => '2019-12-01 00:00:00',

        ]);

        //EXPEDIENTES
        DB::table('expedientes')->insert([
            'titulo' => 'Caso de bienes inmuebles',
            'Descripcion' => 'Caso de denuncia por derechos de inmuebles',
            'cliente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('expedientes')->insert([
            'titulo' => 'Caso de herencia',
            'Descripcion' => 'Caso de denuncia por herencia',
            'cliente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('expedientes')->insert([
            'titulo' => 'Caso de robo',
            'Descripcion' => 'Caso de denuncia por robo',
            'cliente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('expedientes')->insert([
            'titulo' => 'Caso de expropiacion de tierras',
            'Descripcion' => 'Caso de denuncia por expopriacion',
            'cliente_id'=> 3,
            'created_at' => now(),
        ]);
        // EXPEDIENTES USER
        DB::table('expediente_users')->insert([
            'user_id' => 2,
            'expediente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 6,
            'expediente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 5,
            'expediente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 2,
            'expediente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 6,
            'expediente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 8,
            'expediente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 2,
            'expediente_id'=> 3,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 3,
            'expediente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 3,
            'expediente_id'=> 7,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 6,
            'expediente_id'=> 3,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 5,
            'expediente_id'=> 3,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 7,
            'expediente_id'=> 3,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 4,
            'expediente_id'=> 4,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 6,
            'expediente_id'=> 4,
            'created_at' => now(),
        ]);
        DB::table('expediente_users')->insert([
            'user_id' => 8,
            'expediente_id'=> 4,
            'created_at' => now(),
        ]);
        //cliente_users
        DB::table('cliente_users')->insert([
            'user_id' => 2,
            'cliente_id'=> 1,
            'created_at' => now(),
        ]);
        DB::table('cliente_users')->insert([
            'user_id' => 2,
            'cliente_id'=> 2,
            'created_at' => now(),
        ]);
        DB::table('cliente_users')->insert([
            'user_id' => 2,
            'cliente_id'=> 3,
            'created_at' => now(),
        ]);
        DB::table('cliente_users')->insert([
            'user_id' => 4,
            'cliente_id'=> 3,
            'created_at' => now(),
        ]);

    }
}
