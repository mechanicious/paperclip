<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('UserTableSeeder');
        $this->call('LanguageTableSeeder');

        $this->command->info('User table seeded!');
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::unguard();
        User::create(array(
            'email' => 'foo@bar.com',
            'password' => Hash::make('foofoofoo'),
            'firstname' => 'John',
            'lastname' => 'Doe',
            ));
        User::reguard();
    }

}

class LanguageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('languages')->delete();
        Language::unguard();
        Language::create(array(
            'language' => 'Nederlands',
            'abbreviation' => 'nl',
            'user_id' => '1',
            ));
        Language::reguard();
    }

}