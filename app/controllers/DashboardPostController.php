<?php
use PaperClip\Support\Contracts\PaperClipDashboardModelManagementController;
use Illuminate\Laravel\Validator\Validator as Validator;

class DashboardPostController extends PaperClipDashboardModelManagementController {
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
		$restorationTriggers = array('');
		// TODO: Multiple Categories
		$inputNames = array('title', 'post', 'candy_id');
		$validator = $this->makeValidator($inputNames);
		if($validator->fails())
		{
			\Notifier::putError($validator);
			return \Redirect::route('admin.dashboard.'  . $this->ltitle());
		}

		$modelName = '\\' . $this->title();
		$item = new $modelName;
		// Triggers happen to be the input fields user fills in.
		// The input fields are named the same the database columns
		// are named. It's a requirement.
		foreach($inputNames as $name)
			$item->$name = \Input::get($name);
		$item->user_id 	= \Auth::id();
		$item->save();
		$item->setCategoryAttribute(Input::get('category_id'), array('post_id' => $item->id));

		\Notifier::putSuccess(\Lang::get('admin.item-added', array('item' => \Lang::get('adminItems.'  . $this->ltitle()))));

		return \Redirect::route('admin.dashboard.'  . $this->ltitle());
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
		return $this->editStub($id, array(
			'id',
			'title', 
			'post', 
			'candy_id'));
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

		$inputs = array(
			'title', 
			'post', 
			'candy_id');
		$restoreTriggers = array();
		$unique = array();
		Post::findOrFail(Input::get('id'))->setCategoryAttribute(Input::get('category_id'), array('post_id' => Input::get('id')));

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