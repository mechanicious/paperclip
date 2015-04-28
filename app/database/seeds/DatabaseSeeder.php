<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
		// $this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
        	// 'id' 				=> 'foo@bar.com',
        	'firstname' 		=> 'Foo',
        	'lastname' 			=> 'Bar',
        	'password' 			=> Hash::make('foobarbaz'),
        	'email' 			=> 'foo@bar.com',
        	'remember_token' 	=> str_repeat('t', 100)
        	// 'created_at' 		=> 'foo@bar.com',
        	// 'updated_at' 		=> 'foo@bar.com',
        	));
    }
}

class LanguageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('languages')->delete();

        User::create(array(
        	// 'id' 				=> 'foo@bar.com',
        	'language' 			=> 'English',
        	'abbreviation' 		=> 'en',
        	'user_id' 			=> '1'
        	// 'created_at' 		=> 'foo@bar.com',
        	// 'updated_at' 		=> 'foo@bar.com',
        	));
    }
}

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        User::create(array(
        	// 'id' 				=> 'foo@bar.com',
        	'category' 			=> 'News',
        	'description' 		=> NULL,
        	'user_id' 			=> '1',
        	'language_id' 		=> '1'
        	// 'created_at' 		=> 'foo@bar.com',
        	// 'updated_at' 		=> 'foo@bar.com',
        	));
    }
}

class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->delete();

        User::create(array(
        	// 'id' 				=> 'foo@bar.com',
        	'title' 			=> 'Standard Post Check',
        	'post' 				=> NULL,
        	'category_id' 		=> '1',
        	'user_id' 			=> '1'
        	// 'created_at' 		=> 'foo@bar.com',
        	// 'updated_at' 		=> 'foo@bar.com',
        	));
    }
}