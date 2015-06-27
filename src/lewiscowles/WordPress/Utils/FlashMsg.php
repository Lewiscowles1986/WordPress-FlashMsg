<?php

namespace lewiscowles\WordPress\Utils;

class FlashMsg {

	const REGULAR = 'updated fade';
	const ERROR = 'error';

	protected static $messages = array();

	public function __construct() {
		add_action('admin_notices', array( $this, 'showAdminMessages' ) );
	}

	public static function addError( $message ) {
		static::addMessage( $message, self::ERROR );
	}

	public static function addMessage( $message, $htmlclass = self::REGULAR ) {
		static::$messages[] = array( 'html' => $message, 'htmlclass' => $htmlclass );
	}

	public static function showMessage( $message, $htmlclass = self::REGULAR ) {
		echo sprintf(
			'<div id="message" class="%s"><p><strong>%s</strong></p></div>',
			$htmlclass, $message
		);
	}

	public function showAdminMessages() {
		foreach( static::$messages as $message ) {
			$type = $message['htmlclass'];
			$msg = $message['html'];
		    self::showMessage( $msg, $type );
		}
	}

}
