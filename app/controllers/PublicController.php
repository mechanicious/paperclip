<?php

class PublicController extends \BaseController {
	protected $layout = 'theme.eline._layout';

	public function index()
	{
		$this->layout->content = View::make('theme.eline.home.index');
		return $this->layout->render();
	}
	
	public function post($langAbbr, $id)
	{
		$post = Post::whereId($id);
		if( is_null($post) ) return Redirect::route('public.index');
		$this->layout->content = View::make('theme.eline.post.index')->with(array('post' => $post));
		return $this->layout->render();
	}

	public function category($langAbbr, $id)
	{
		$category = Category::whereId($id);
		if( is_null($category) ) return Redirect::route('public.index');
		$this->layout->content = View::make('theme.eline.category.index')->with(array('category' => $category));
		return $this->layout->render();
	}

	public function welcome()
	{
		'theme.default.welcome';
		return $this->layout->render();
	}
}