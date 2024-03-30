<?php

namespace Database\Seeders;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected static ?string $password;
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
            'name' => "Miguel Mateus",
            'email' => "953854043",
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'bi'=> fake()->name(),
            'it_tipo_utilizador' => 3,
        ]);
        \App\Models\User::factory()->create([
            'name' => "Isabel Mateus",
            'email' => "957572349",
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'bi'=> fake()->name(),
            'it_tipo_utilizador' => 4,
        ]);
    }
}
