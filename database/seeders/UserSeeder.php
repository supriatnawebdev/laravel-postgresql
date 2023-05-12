<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data dummy
        $users = [
            [
                'email' => 'john@example.com',
                'username' => 'John Doe',
                'password' => bcrypt('secret'),
                'firstname' => 'John',
                'lastname' => 'Doe'
            ],
        ];
        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }
        

    }
}

