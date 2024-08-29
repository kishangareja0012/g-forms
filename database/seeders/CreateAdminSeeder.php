<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => $this->command->ask("Enter name"),
            'email' => $this->command->ask("Enter email"),
            'password' => $this->command->secret("Enter password"),
            'password_confirmation' => $this->command->secret("Re-enter password")
        ];

        $validate = Validator::make($admin, [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        if ($validate->fails()) {
            foreach ($validate->errors()->toArray() as $field => $message) {
                $this->command->error("{$field} : " . implode(',', $message));
            }
        } else {
            try {
                User::create([
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => Hash::make($admin['password'])
                ]);

                $this->command->info("Admin created successfully");
                $this->command->info("Click here to login as Admin : " . route('login.index'));
            } catch (Exception $e) {
                $this->command->error($e->getMessage());
            }
        }
    }
}
