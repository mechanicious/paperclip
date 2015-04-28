<?php namespace PaperClip\DonateButtonLocalizer;

/**
 * Allows the user select what news to display.
 */
class DonateButtonLocalizer extends \PaperClip\Support\Contracts\Widget
{
  /**
   * The widget settings
   * @var array
   */
  protected $settings = array();

  /**
   * The settings user has submitted
   * @var array
   */
  protected $userSettings = array();

  /**
   * For efficiency reason we don't use language names but 
   * Settings format:
   * Language Name => Category Id
   * E.g. English => 2
   */
  public function __construct()
  {
    $this->settings = array(
      'title'             => \Lang::get('widget/donate_button_localizer/install.title'),
      'author'            => 'Mateusz Zawartka',
      // strictName has to be the same as the class name
      'strictName'        => 'DonateButtonLocalizer',
      'userSettings'      => null,
      'description'       => \Lang::get('widget/donate_button_localizer/install.description'),
      'bodyTemplateName'  => 'admin.dashboard.widgets.donate_button_localizer.index',
      'user_id'           => \Auth::id(),
      'previousVersion'   => null,
      'currentVersion'    => "0.1",
      );

    $this->userSettings = $this->getUserSettings();
  }
  /**
   * Installs the News Localizer
   * @return boolean
   */
  public function install()
  {
    if(($validator = parent::install()) instanceof \Illuminate\Support\MessageBag)
    {
      \Notifier::putError($validator);
      return \Redirect::route('admin.dashboard.widget');
    }
    \Notifier::putSuccess(\Lang::get('widget/donate_button_localizer/install.installation-successfull'));
    return \Redirect::route('admin.dashboard.widget');
  }

  /**
   * Uninstalls the widget.
   * @return boolean
   */
  public function uninstall()
  {
    \Notifier::putInfo("Too bad you're uninstalling Donate Button Localizer. Hope we'll see eachother again!");
    return parent::uninstall();
  }

  public function getCurrentLangUrl() {
    $currLang = \Cache::get('locale.language')->language;
    return $this->getUserSettings($currLang);
  }

  public function getUrlWithLang($lang) {
    if(! is_string($lang)) return null;
    return $this->getUserSettings($lang);
  }

  /**
   * Get user settings
   * @param  string $fieldname
   * @return array | string | null
   */
  public function getUserSettings($fieldname = null)
  { 
    return @parent::getUserSettings($fieldname);
  }
}