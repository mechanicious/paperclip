<?php

class DashboardMassEmailController extends \BaseController {
	protected $title = "Mass Email";
	/**
	 * Display a listing of the resource.
	 * GET /dashboardlanguage
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.dashboard.mass.index', array(
			"title" => $this->title
			));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dashboardmassemail/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboardmassemail
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /dashboardmassemail/{id}
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
	 * GET /dashboardmassemail/{id}/edit
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
	 * PUT /dashboardmassemail/{id}
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
	 * DELETE /dashboardmassemail/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}