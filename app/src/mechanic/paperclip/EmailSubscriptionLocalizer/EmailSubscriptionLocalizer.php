<?php namespace PaperClip\EmailSubscriptionLocalizer;

/**
 * Allows the user select what news to display.
 */
class EmailSubscriptionLocalizer extends \PaperClip\Support\Contracts\Widget
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
      'title'             => \Lang::get('widget/email_subscription_localizer/install.title'),
      'author'            => 'Mateusz Zawartka',
      // strictName has to be the same as the class name
      'strictName'        => 'EmailSubscriptionLocalizer',
      'userSettings'      => null,
      'description'       => \Lang::get('widget/email_subscription_localizer/install.description'),
      'bodyTemplateName'  => 'admin.dashboard.widgets.email_subscription_localizer.index',
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
    // if(! class_exists('\Schema')) return \Notifier::putError('Schema object is not available.');
    // \Schema::create('esl_emails', function($table) {
    //   $table->increments('id');
    //   $table->text('form_action_url');
    //   $table->integer('language_id')->unsigned();
    //   $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
    // });
    if(($validator = parent::install()) instanceof \Illuminate\Support\MessageBag)
    {
      \Notifier::putError($validator);
      return \Redirect::route('admin.dashboard.widget');
    }
    \Notifier::putSuccess(\Lang::get('widget/email_subscription_localizer/install.installation-successfull'));
    return \Redirect::route('admin.dashboard.widget');
  }

  /**
   * Uninstalls the widget.
   * @return boolean
   */
  public function uninstall()
  {
    \Notifier::putInfo("Too bad you're uninstalling Email Subscription Localizer. Hope we'll see eachother again!");
    return parent::uninstall();
  }

  /**
   * The the handler subscription URL by language name;s
   * @param  srtring $lang
   * @return string
   */
  public function getUrlWithLang($lang) {
    return $this->getUserSettings($lang);
  }

  /**
   * The the handler subscription URL by language name;s
   * @param  srtring $lang
   * @return string
   */
  public function getCurrentLangUrl() {
    return $this->getUserSettings(\Cache::get('locale.language')->language);
  }

  public function getCurrentLangInputCode() {
    $currLangUrl = $this->getUserSettings(\Cache::get('locale.language')->language);
    if(! $currLangUrl || strlen($currLangUrl) <= 0) return null;
    $segments = explode('/', $currLangUrl);
    return $segments[count($segments)-2];
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