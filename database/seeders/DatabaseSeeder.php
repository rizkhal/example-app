<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "username" => "test",
            "email" => "test@mail.com",
            "password" => Hash::make("rahasia123"),
            "phone" => "12345",
            "address" => "jl. test",
            "city" => "kota tua",
            "country" => "negara tua",
            "name" => "insomnia",
            "city" => "123",
            "postcode" => "94202"
        ]);
    }
}
