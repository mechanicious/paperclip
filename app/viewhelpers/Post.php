<?php namespace ViewHelpers;

class Post {
  /**
   * Echo check on category match.
   * @param  string $postId
   * @param  string $categoryId
   * @return string||null
   */
  public function checkInputOnCategoryMatch($postId, $categoryId) {
    if(is_null($postId) || is_null($categoryId)) return ''; 
    $postCatId = \Post::whereId($postId)->getCategoryId();
    if (isset($postCatId) && ! is_null($postCatId) && $postCatId === $categoryId) {
      echo "checked='true'";
    }
  }
}