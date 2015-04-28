<?php namespace PaperClip\Notifier;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Contracts\MessageProviderInterface;
use Carbon\Carbon;

/**
 * Relies on Session.
 * TODO: Notification Class
 * TODO: putTimedError[session, day, minute...]
 * TODO: relay on MessageBag
 */
class Notifier
{
	private $session 		= null;
	private $notifier 		= null;
	private $sessionPrefix 	= 'notifications';		

	public function __construct(SessionManager $session, $omitInit = false)
	{
		$this->session 	= $session;
		if(! $omitInit) $this->initialize();
	}

	public function initialize($force = false)
	{
		if(!$this->getAll() || $force)
			$this->notifier = $this->session->flash($this->sessionPrefix, array(
			'success'	=> array(),
			'error'		=> array(),
			'warning'	=> array(),	
			'info'		=> array(),	
			));
	}

	private function getAll()
	{
		return $this->session->get($this->sessionPrefix);
	}

	private function array_mesh() 
	{
	    $numargs 	= func_num_args();
	    $arg_list = func_get_args();
	    $out = array();

	    for ($i = 0; $i < $numargs; $i++) {
	        $in = $arg_list[$i];
	        foreach($in as $key => $value) {
	            if (array_key_exists($key, $out)) {
	                $sum = $in[$key] + $out[$key];
	                $out[$key] = $sum;
	            }
	            else
	                $out[$key] = $in[$key];
	        }
	    }   
	    return $out;
	}

	private function buildMessageArray($type, $message)
	{
		if (!is_string($message) && !is_array($message) && !($message instanceof MessageProviderInterface))
			throw new \Exception("A message must satisfy Illuminate\Support\Contracts\MessageProviderInteraface,
			or be either a string or an array");
			
		$messages = $this->getAll();

		if ($message instanceof MessageProviderInterface)
		{
			$messages[$type] = array_merge($messages[$type], $message->getMessageBag()->all());
		}

		if (is_array($message))
		{
			$messages[$type] = array_merge($messages[$type], $message);
		}

		if (is_string($message))
		{
			array_push($messages[$type], $message);
		}

		return $messages;		
	}

	private function putMessage($type, $message, $once = false)
	{
		$this->session->flash($this->sessionPrefix, $this->array_mesh(
			$this->buildMessageArray($type, $message),
			$this->getAll()));
	}

	private function getMessages($type)
	{
		$messages = $this->getAll();
		return $messages[$type];
	}

	public function all()
	{
		return $this->getAll();
	}

	public function putError($message, $once = false)
	{
		$this->putMessage('error', $message, $once = false);
		return $this;
	}

	public function putSuccess($message, $once = false)
	{
		$this->putMessage('success', $message, $once = false);
		return $this;
	}

	public function putWarning($message, $once = false)
	{
		$this->putMessage('warning', $message, $once = false);
		return $this;
	}

	public function putInfo($message, $once = false)
	{
		$this->putMessage('info', $message, $once = false);
		return $this;
	}

	public function getErrorMessages()
	{
		return $this->getMessages('error');
	}
	
	public function getSuccessMessages()
	{
		return $this->getMessages('success');
	}
	
	public function getWarningMessages()
	{
		return $this->getMessages('warning');
	}
	
	public function getInfoMessages()
	{
		return $this->getMessages('info');
	}

	/**
	 * Puts an info message to notifications.
	 * @param string $message
	 */
	public function clear()
	{
		$this->initialize(true);
		return $this;
	}
}