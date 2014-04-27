<?php

require("CaptchaSpec.php");

class Randomizer{
	function getRandomPattern(){
		return rand(1,2);
	}
	
	function getRandomFirstOperand(){
		return rand(0,9);
	}
	
	function getRandomOperator(){
		return rand(1,3);
	}
	
	function getRandomSecondOperand(){
		return rand(0,9);
	}
}

class RandomizerSpec extends PHPUnit_Framework_TestCase {
	function testGetRandomPattern(){
		$myRandomizer = new Randomizer();
		$this->assertLessThan(3,$myRandomizer->getRandomPattern());
	}
	
	function testGetRandomPatternShouldGreaterThanZero(){
		$myRandomizer = new Randomizer();
		$this->assertGreaterThan(0,$myRandomizer->getRandomPattern());
	}
	
	function testCaptchaReturnAnyStringWithGetRandomPatternShouldGreaterThanZero(){
		$myRandomizer = new Randomizer();
		$myCaptcha = new Captcha($myRandomizer->getRandomPattern(),1,1,1);
		$this->assertStringMatchesFormat("%s",$myCaptcha->toString());
	}
	
	function testGetRandomPatternRange(){
		$myRandomizer = new Randomizer();
		$this->assertContains($myRandomizer->getRandomPattern(),array(1,2));
	}
	
	function testGetRandomFirstOperandRange(){
		$myRandomizer = new Randomizer();
		$this->assertContains($myRandomizer->getRandomFirstOperand(),array(0,1,2,3,4,5,6,7,8,9));
	}
	
	function testGetRandomOperatorRange(){
		$myRandomizer = new Randomizer();
		$this->assertContains($myRandomizer->getRandomOperator(),array(1,2,3));
	}
	
	function testGetRandomSecondOperandRange(){
		$myRandomizer = new Randomizer();
		$this->assertContains($myRandomizer->getRandomSecondOperand(),array(0,1,2,3,4,5,6,7,8,9));
	}
	
	function test(){
		$myRandomizer = new Randomizer();
		$this->assertContains($myRandomizer->getRandomSecondOperand(),array(0,1,2,3,4,5,6,7,8,9));
	}
}
