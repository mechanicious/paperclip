<?php 

class DashboardWidgetController extends \BaseController
{
	// TODO: WidgetsDBEntry should be WidgetsModel
	public function index()
	{
		return View::make('admin.dashboard.widgets.index', array('localeTitle' => 'Widgets'));
	}

	/**
	 * Redirect user somewhere safe.
	 * @return Illuminate\Http\RedirectResponse
	 */
	protected function redirectFallback()
	{
		return Redirect::route('admin.dashboard.widget');
	}

	/**
	 * Widget not found fallback.
	 * @return Illuminate\Http\RedirectResponse
	 */
	protected function widgetNotFound()
	{
		Notifier::putError("The widget could not be found");
		return $this->redirectFallback();
	}

	/**
	 * Get the widget model.
	 * @param  numeric $id
	 * @return mixed | null
	 */
	protected function getWidget($id)
	{
		return $widget = Widget::where('id', '=', $id)->first();	
	}

	/**
	 * Get the widget or fallback.
	 * @return mixed | null | Illuminate\Http\RedirectResponse
	 */
	protected function widgetOrFallback($id)
	{
		if(!is_null($widget = $this->getWidget($id))) return $widget;
		else return $this->widgetNotFound();
	}

	/**
	 * Experimental route
	 * @return Illuminate\Http\RedirectResponse
	 */
	public function install($id)
	{
		EmailSubscriptionLocalizer::install();
		NewsLocalizer::install();
		return DonateButtonLocalizer::install();
	}

	/**
	 * Show widget page. 
	 * @param  numeric $id
	 * @return Illuminate\View\View
	 */
	public function show($id)
	{
		$widgetsDBEntry = $this->widgetOrFallback($id);
		$view = $widgetsDBEntry->bodyTemplateName;
		return View::make($view)->with(array(
			'id' => $id, 
			'localeTitle' => 'Widgets', 
			'widgetTitle' => $widgetsDBEntry->title,
			'menuHeaderCSS' => 'background-color: #0090BA !important;',
			));
	}

	/**
	 * Update widget's user settings.
	 * @param  numeric $id
	 * @return Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		$widgetsDBEntry = $this->widgetOrFallback($id);
		$widgetsDBEntry->userSettings = serialize(Input::all());
		$widgetsDBEntry->save();
		Notifier::putSuccess(Lang::get('admin.item-updated', array('item' => Lang::get('adminItems.widget'))));
		return Redirect::route('admin.dashboard.widget.show', $id);
	}

	/**
	 * Remove widget.
	 * @param  numeric $id
	 * @return Illuminate\Http\RedirectResponse
	 */
	public function destroy($id)
	{
		$widgetsDBEntry = $this->widgetOrFallback($id);
		$strictName = $widgetsDBEntry->strictName;
		// Use the widget's uninstall function
		$strictName::uninstall();
		Notifier::putSuccess(Lang::get('admin.item-removed', array('item' => Lang::get('adminItems.widget'))));
		return $this->redirectFallback();
	}
}