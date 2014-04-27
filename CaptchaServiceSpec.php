<?php

require("RandomizerSpec.php");

class CaptchaService {
	private $myRandomizer;

	function __construct(){
		$this->myRandomizer = new Randomizer();
	}

	function getCaptcha(){
		return new Captcha($this->myRandomizer->getRandomPattern(),$this->myRandomizer->getRandomFirstOperand(),$this->myRandomizer->getRandomOperator(),$this->myRandomizer->getRandomSecondOperand());
	}
	
	function setRandomizer($randomizer){
		$this->myRandomizer = $randomizer;
	}
}

class CaptchaServiceSpec extends PHPUnit_Framework_TestCase {
	function test(){
	
		$stub = $this->getMock('Randomizer');

		$stub->expects($this->any())
			->method('getRandomPattern')
			->will($this->returnValue(1));
		$stub->expects($this->any())
			->method('getRandomFirstOperand')
			->will($this->returnValue(1));
		$stub->expects($this->any())
			->method('getRandomOperator')
			->will($this->returnValue(1));
		$stub->expects($this->any())
			->method('getRandomSecondOperand')
			->will($this->returnValue(1));
	
		$myCaptchaService = new CaptchaService();

		$myCaptchaService->setRandomizer($stub);

		$this->assertEquals(new Captcha(1,1,1,1),$myCaptchaService->getCaptcha());
	}

	function testGetCaptchaShouldReturnInstanceOfCaptcha() {
	  $captchaService = new CaptchaService();
	  $this->assertTrue($captchaService->getCaptcha() instanceof Captcha);
    }

}
