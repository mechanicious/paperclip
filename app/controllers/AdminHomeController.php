<?php
use Illuminate\Support\MessageBag;

class AdminHomeController extends \BaseController {
	protected $title = "Beheer";
	/**
	 * Display a listing of the resource.
	 * GET /dashboardlanguage
	 *
	 * @return Response
	 */
	public function prepare()
	{
		return \NewsLocalizer::install();
	}

	public function index()
	{
		return View::make('admin.home.index', array(
			"title" => $this->title
			));
	}

	public function login()
	{
		$validator = Validator::make(
			array(
			'email' 	=> Input::get('email'),
			'password' 	=> Input::get('password')
			),
			array(
			'email' 	=> 'required|email|digits_between:5,60',
			'password' 	=> 'required|digits_between:8,25'
			));

		if($validator->fails())
		{
			Notifier::putError($validator);
			return Redirect::route('admin.home');
		}

		if(!Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), Input::has('remember') ? true : false))
		{
			Notifier::putError(Lang::get('validation.credentials'));
			return Redirect::route('admin.home');
		}

		return Redirect::route('admin.dashboard');
	}
}