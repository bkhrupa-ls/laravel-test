<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public $users = [
        [
            'name' => 'Sales Agent',
            'email' => 'sales@coffee.shop',
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $user) {
            if (!User::query()->where('email', $user['email'])->exists()) {
                User::factory()->create($user);
            }
        }
    }
}
