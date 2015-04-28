<?php

class DashboardSocialMediaController extends \BaseController {
	protected $title = "Social Media";
	/**
	 * Display a listing of the resource.
	 * GET /dashboardlanguage
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.dashboard.social.index', array(
			"title" => $this->title
			));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dashboardsocialmedia/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboardsocialmedia
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /dashboardsocialmedia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dashboardsocialmedia/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /dashboardsocialmedia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dashboardsocialmedia/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}