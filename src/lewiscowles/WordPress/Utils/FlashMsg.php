<?php

namespace lewiscowles\WordPress\Utils;

class FlashMsg {

	const REGULAR = 'updated fade';
	const ERROR = 'error';

	protected static $_messages = array();

	public function __construct() {
		\add_action('admin_notices', array( $this, 'showAdminMessages' ) );
	}

	public static function addError( $message ) {
		static::addMessage( $message, self::ERROR );
	}

	public static function addMessage( $message, $htmlclass = self::REGULAR ) {
		static::$_messages[] = array( 'html' => $message, 'htmlclass' => $htmlclass );
	}

	public static function showMessage( $message, $htmlclass = self::REGULAR ) {
		return sprintf(
			'<div id="message" class="%s"><p><strong>%s</strong></p></div>',
			$htmlclass, $message
		);
	}

	public static function getMessages() {
		return static::$_messages;
	}

	public static function resetMessages() {
		static::$_messages = array();
	}

	public static function showAdminMessages() {
		foreach( static::$_messages as $message ) {
			$type = $message['htmlclass'];
			$msg = $message['html'];
		    echo self::showMessage( $msg, $type );
		}
	}

}
