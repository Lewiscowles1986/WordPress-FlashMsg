<?php

use lewiscowles\WordPress\Utils\FlashMsg;

class MainTest extends \PHPUnit_Framework_TestCase
{
	protected $_messageDispatcher;

	public function setUp()
	{
		$this->_messageDispatcher = new FlashMsg();
	}

	public function testAlwaysTrue()
	{
		$this->assertTrue( true );
	}

	public function testIsObject()
	{
		$this->assertTrue( is_object( $this->_messageDispatcher ) );
	}

	public function testIsFlasMsg()
	{
		$this->assertTrue( ( $this->_messageDispatcher instanceof FlashMsg ) );
	}

	public function testSampleError()
	{
		FlashMsg::resetMessages();
		FlashMsg::addError( 'Oh Noes!' );
		FlashMsg::showAdminMessages();
		$this->expectOutputString( FlashMsg::showMessage( 'Oh Noes!', FlashMsg::ERROR ) );
	}

	public function testSampleMessage()
	{
		FlashMsg::resetMessages();
		FlashMsg::addMessage( 'Testing 123...' );
		FlashMsg::showAdminMessages();
		$this->expectOutputString( FlashMsg::showMessage( 'Testing 123...', FlashMsg::REGULAR ) );
	}

	public function testClearMessages()
	{
		echo "pre";
		FlashMsg::addMessage('Hi');
		FlashMsg::resetMessages();
		FlashMsg::showAdminMessages();
		$this->expectOutputString("pre");
	}

}
