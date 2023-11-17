<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id'      => 1,
            'uuid'    => Str::uuid(),
            'name'    => 'Cristian',
            'email'   => 'cristiankozlowski@hotmail.com',
            'password'=> bcrypt('123456*'),
        ]);

        User::create([
            'id'      => 2,
            'uuid'    => Str::uuid(),
            'name'    => 'John',
            'email'   => 'john@hotmail.com',
            'password'=> bcrypt('teste*'),
        ]);
    }
}
