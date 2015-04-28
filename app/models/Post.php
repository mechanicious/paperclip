<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Post extends PaperClipModel implements TablezatorInterface 
{
	protected $fillable = [];

    public function languages()
    {
        return $this->categories()->first()->language()->first();
    }

    public static function whereId($id)
    {
        return Post::whereNull('deleted_at')->where('id', '=', $id)->first();
    }


    public function getCategoryId() {
        $category = $this->categories()->first();
        if( ! is_null($category)) return $category->id;
        return;
    }


    /**
     * Get the latest category post siblings
     * 
     * @param  integer $amount
     * @return Illuminate\Support\Collection | null
     */
    public function latestCategorySiblings($amount = 4)
    {
        return $this->categories()->where('language_id', '=', $this->categories()->first()->language_id)->first()->posts()
        ->where('posts.id', '!=', $this->id)->take($amount)->latest()->get();
    }

    public function contentChunk($amountWords)
    {
        return Verse::equals($this->post)->stripTags()->first($amountWords)->append('...')->get();
    }

	public function categories()
    {
        return $this->belongsToMany('Category');
    }

    public function getLatestPost()
    {
        $category = Category::where('deleted_at', '=', null)->first();
        if( ! is_null($category) )
        return $category
        ->where('language_id', '=', $this->categories()->first()->language_id)->first()->posts()->take(4)->get();
    }

    public function setCategoryAttribute($ids, $postID)
    {
        foreach(Category::all() as $cat)
            $this->categories()->detach($cat->id);
        if(is_array($ids))
            foreach ($ids as $id)
                $this->categories()->attach($id, $postID); 
        else
            $this->categories()->attach($ids, $postID);
    }

    public function postUrl()
    {
        return route('public.post', array('id' => $this->id, 'lang' => $this->languages()->abbreviation, 'title' => dash_encode($this->title)));
    }

    public function getCandy()
    {
        return Candy::where('id', '=', $this->candy_id)->first();
    }

    public function user()
    {
        return $this->hasOne('User');
    }

    // Tablezator::unforgenize will look for this.
	public function identify()
	{
		return $this->title; 
	}
}