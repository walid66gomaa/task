<?php

use App\Models\Auth\User;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Add the master administrator, user id of 1
        User::create([
            'first_name'        => 'Admin',
            'last_name'         => 'Instructor',
            'email'             => 'admin@cloud.com',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

    

    

        User::create([
            'first_name'        => 'user',
            'last_name'         => 'User',
            'email'             => 'user@cloud.com',
            'password'          => 'secret',
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]);

        $this->enableForeignKeys();
    }
}
