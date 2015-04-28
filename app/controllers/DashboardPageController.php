<?php
use PaperClip\Support\Contracts\PaperClipDashboardModelManagementController;

class DashboardPageController extends PaperClipDashboardModelManagementController {
	protected $domain = 'admin.dashboard';
	
	public function index()
	{
		return $this->setupLayout();
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dashboardlanguage
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array('language_id', 'content', 'name', 'password');
		$restoreTriggers = array('id');
		return $this->storeStub($input, $restoreTriggers);
	}

	/**
	 * Display the specified resource.
	 * GET /dashboardlanguage/{id}
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
	 * GET /dashboardlanguage/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return $this->editStub($id, array('language_id', 'content', 'name', 'password'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /dashboardlanguage/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$inputs = array('language_id', 'content', 'name', 'password');
		return $this->updateStub($id, $inputs, $restoreTriggers, $unique);
	}

	/**
	 * Retores an soft-deleted item.
	 * @param  numeric $id
	 * @return Response
	 */	
	public function restore($id)
	{
		return $this->restoreStub($id);
	}
	/**
	 * Remove the specified resource from storage.
	 * DELETE /dashboardlanguage/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->destroyStub($id);
	}

}