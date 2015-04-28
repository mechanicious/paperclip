<?php
use PaperClip\Support\Contracts\PaperClipDashboardModelManagementController;
use Illuminate\Laravel\Validator\Validator as Validator;

class DashboardUserController extends BaseController {
	
	public function index()
	{

	}
	/**
	 * Retores an soft-deleted item.
	 * @param  numeric $id
	 * @return Response
	 */	
	public function logout()
	{
		Auth::logout();
		return Redirect::route('admin.home');
	}

}