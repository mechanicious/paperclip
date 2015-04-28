<?php 

use PaperClip\Support\Contracts\PaperClipDashboardController;


class DashboardHomeController extends PaperClipDashboardController {
	// Where should the script look for the view layout?
	protected $domain = 'admin.dashboard';

	public function index()
	{
		return $this->setupLayout();
	}

}