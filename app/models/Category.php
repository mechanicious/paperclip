<?php

use PaperClip\Support\Contracts\PaperClipModel;
use PaperClip\Support\Contracts\TablezatorInterface;

class Category extends PaperClipModel 
{
    protected $fillable = [];

    public function posts()
    {
        return $this->belongsToMany("Post");
    }

    public function getCategoryPageUrl()
    {
        return route('public.category', array(
            'id'    => $this->id, 
            'title' => dash_encode($this->category), 
            'lang'  => $this->language->first()->abbreviation
            )
        );
    }

    public function getLanguageSiblingCategories()
    {
        return Category::where('language_id', '=', $this->language_id)
        ->where('deleted_at', '=', null)->get();
    }

    public function language()
    {
        return $this->belongsTo('Language');
    }

    public function user()
    {
        return $this->hasOne('User');
    }

    // Tablezator::unforgenize will look for this.
    public function identify()
    {
        return $this->category; 
    }

    public static function whereId($id)
    {
       return Category::whereNull('deleted_at')->where('id', '=', $id)->first();
    }

    public static function whereLangAndCatId($langId, $catId) {
        return \Category::where('deleted_at', '=', null)->where('language_id', '=', $langId)
        ->where('id', '=', $catId)->first();
    }

    public function latestPosts() {
       return $this->posts()->latest()->where('posts.deleted_at', '=', null);
    }

    public static function whereLangId($id) {
        return \Category::whereNull('deleted_at')->where('language_id', '=', $id);
    }
}