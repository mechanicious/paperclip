<?php

class AdminSignupController extends \BaseController {
	
	protected $title = "Beheer - Signup";
	/**
	 * Display a listing of the resource.
	 * GET /dashboardlanguage
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.signup.index', array(
			"title" => $this->title
			));
	}

	public function create()
	{
		// TODO: Log and ban malicious activity
		$validator = Validator::make(
		    array(
		        'authtoken' 			=> Input::get('authtoken'),
		        'firstname' 			=> Input::get('firstname'),
		        'lastname' 				=> Input::get('lastname'),
		        'password' 				=> Input::get('password'),
		        'password_confirmation' => Input::get('password_confirmation'),
		        'email' 				=> Input::get('email')
		    ),
		    array(
		    	'authtoken' 			=> 'required|in:^hG8J9)J01*77")|max:32',
		        'firstname' 			=> 'required|digits_between:2,15',
		        'lastname' 				=> 'required|digits_between:2,15',
		        'password' 				=> 'required|confirmed|digits_between:8,25',
		        'email' 				=> 'required|email|unique:users|digits_between:5,60'
		    )
		);

		if ($validator->fails())
		{
			// Refill the form
			Notifier::putError($validator);
			return Redirect::route('admin.signup')->with('input', Input::except(array('password', 'authtoken')));
		}

		// Create user
		$user = new User;
		$user->firstname 	= Input::get('firstname');
		$user->lastname 	= Input::get('lastname');
		$user->email 		= Input::get('email');
		$user->password 	= Hash::make(Input::get('password'));
		$user->save();

		// Trigger view/_alert success section 
		Notifier::putSuccess(Lang::get('admin.registration', array('firstname' => Input::get('firstname'))));
		Notifier::putInfo("An confirmation email has been sent to " . Input::get('email') );
		
		return Redirect::route('admin.signup');
	}
}