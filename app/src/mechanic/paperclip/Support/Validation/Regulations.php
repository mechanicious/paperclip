<?php namespace PaperClip\Support\Validation;

		/**
		 * Those are widely used rules. You use and decorate them freely.
		 * @var array
		 */
		$universal = array(
			'id' 	=> 'required|numeric|digits_between:1,10',
			'name' 	=> 'required|digits_between:1,10|alpha',
			);
		
		// Language
		$language = array(
			// This id regulation is used when user attempts to edit a post.
			'id' 			=> $universal['id'] . '|exists:languages,id',
			'language' 		=> $universal['name'] . '|unique:languages',
			'name' 			=> $universal['name'] . '|unique:languages',
			'abbreviation' 	=> 'required|digits_between:1,3|alpha|unique:languages',
			
			'update' => array(
				// This id regulation is used when user attempts to put data into database.
				'id' 			=> $universal['id'] . '|exists:languages,id',
				'language' 		=> $universal['name'] . '|unique:languages,language',
				'name' 			=> $universal['name'] . '|unique:languages,language',
				'abbreviation' 	=> 'required|digits_between:1,3|alpha|unique:languages,abbreviation',
				)
		);

		// Category
		$category =  array(
			'id' 			=> $universal['id'] . '|exists:categories,id',
			'category' 		=> 'required|digits_between:1,35|unique:categories',
			'language_id' 	=> $universal['id'] . 'exists:languages,id',
			'description' 	=> 'digits_between:1,256',
			
			'update' => array(
				'id' 			=> $universal['id'] . '|exists:categories,id',
				'category' 		=> 'required|digits_between:1,35|unique:categories,category',
				'language_id' 	=> $universal['id'] . 'exists:languages,id',
				'description' 	=> 'digits_between:1,256',
				)
		);

		// Post
		$post =  array(
			'id' 			=> $universal['id'] . '|exists:posts,id',
			'title' 		=> 'required|digits_between:1,256',
			'post' 			=> 'digits_between:1,16000000',
			'candy_id' 		=> 'numeric|digits_between:1,10|exists:candies,id',
			'category_id' 	=> 'required|numeric|digits_between:1,10|exists:categories,id',
			
			'update' => array(
				'id' 			=> $universal['id'] . '|exists:posts,id',
				'title' 		=> 'required|digits_between:1,256',
				'post' 			=> 'digits_between:0,16000000',
				'candy_id' 		=> 'numeric|digits_between:1,10|exists:candies,id',
				'category_id' 	=> 'required|numeric|digits_between:1,10|exists:categories,id',
				)
		);

		// User
		$user = array(
			'id' 		=> $universal['id'] . '|exists:users,id',
			'email' 	=> 'required|email|digits_between:5,60|unique:users',
			'password' 	=> 'required|confirmed|digits_between:8,25',
			'authtoken' => 'required|in:^hG8J9)J01*77")|max:32',
			'firstname'	=> 'required|digits_between:2,15',
			'lastname'	=> 'required|digits_between:2,15',
		);

		// Page
		$page = array(
			'id' 			=> $universal['id'] . '|exists:pages,id',
			'name' 			=> 'required|digits_between:1,256',			
			'content' 		=> 'required|digits_between:1,16000000',
			'language_id' 	=> $universal['id'] . 'exists:languages,id',
			'password' 		=> 'digits_between:8,25',
			
			'update' => array(
				'id' 			=> $universal['id'] . '|exists:pages,id',
				'name' 			=> 'required|digits_between:1,256',			
				'content' 			=> 'required|digits_between:1,16000000',
				'language_id' 	=> $universal['id'] . 'exists:languages,id',
				'password' 		=> 'digits_between:8,25',
				)
		);

		// Category
		$candy =  array(
			'id' 			=> $universal['id'] . '|exists:candies,id',
			'name' 			=> 'required|digits_between:1,256',
			'url' 			=> 'required|digits_between:1,256|unique:candies,url',
			
			'update' => array(
				'id' 			=> $universal['id'] . '|exists:candies,id',
				'name' 			=> 'required|digits_between:1,256',
				'url' 			=> 'required|digits_between:1,256|unique:candies,url'
				)
		);

		$widget = array(
			'title' 			=> 'required|digits_between:1,256',
			'strictName'		=> 'required|digits_between:1,256',
			'userSettings' 		=> 'digits_between:1,64000',
			'description' 		=> 'digits_between:1,256',
			'bodyTemplateName' 	=> 'required|digits_between:1,256',
			'user_id' 			=> $universal['id'] . '|exists:users,id',
			'previousVersion' 	=> 'numeric|digits_between:1,11',
			'currentVersion' 	=> 'required|numeric|digits_between:1,11',
			);

return array_dot(array_combine(
	array(
		'language', 
		'category', 
		'post', 
		'user',
		'page',
		'candy',
		'widget',
		),
	array(
		$language,
		$category,
		$post,
		$user,
		$page,
		$candy,
		$widget,
		)));