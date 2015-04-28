<?php namespace API\JSON\Secret;

class Dashboard extends \BaseController {
  static public function loadCandyImagesJson($skip = null, $amount = 1) {
    if( ! is_string($skip)) return json_encode(array());
    return json_encode(\Candy::getCandies($skip, $amount)->get());
  }

  static public function warnNotifications() {
    $notifier = App::register('notifier', true);
    return json_encode($notifier::getWarningMessages());
  }

  static public function infoNotifications() {
    $notifier = App::register('notifier', true);
    return json_encode($notifier::getInfoMessages());
  }

  static public function successNotifications() {
    $notifier = App::register('notifier', true);
    return json_encode($notifier::getSuccessMessages());
  }
  
  static public function errorNotifications() {
    $notifier = App::register('notifier', true);
    return json_encode($notifier::getErrorMessages());
  }
}