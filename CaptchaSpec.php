<?php

class Captcha{
	public $pattern,$firstOperand,$operator,$secondOperand;
	function __construct ($pattern,$firstOperand,$operator,$secondOperand){
		$this->pattern = $pattern;
		$this->firstOperand = $firstOperand;
		$this->operator = $operator;
		$this->secondOperand = $secondOperand;
	}
	function toString(){
		if($this->pattern == 1){
			return $this->getFirstOperand()." ".$this->getOperator()." ".$this->secondOperand;
		}else{
			return $this->firstOperand." ".$this->getOperator()." ". $this->getSecondOperand();
		}
	}
	
	function getStringFromNumber($number){
		$mapNumber = [
			1 => "One", 
			2 => "Two", 
			3 => "Three",
			4 => "Four",
			5 => "Five",
			6 => "Six",
			7 => "Seven",
			8 => "Eight",
			9 => "Nine"
		];
		return $mapNumber[$number];
	}

	function getFirstOperand(){
		return $this->getStringFromNumber($this->firstOperand);
	}

	function getOperator(){
		$mapOperator = [1 => "+", 2 => "*", 3 => "-"];
		return $mapOperator[$this->operator];
	}
	
	function getSecondOperand(){
		return $this->getStringFromNumber($this->secondOperand);
	}

	function getResult(){
		
		switch ($this->operator) {
			case 1:
				$result= $this->firstOperand + $this->secondOperand;
				break;
			case 2:
				$result=$this->firstOperand * $this->secondOperand;
				break;
			case 3:
				$result=$this->firstOperand - $this->secondOperand;
				break;
		}

		return $result;
	}
}

class CaptchaSpec extends PHPUnit_Framework_TestCase {
	function testFirstPatternStringOperatorNumber(){
		$myCaptcha = new Captcha(1,1,1,1);
		$this->assertEquals("One + 1",$myCaptcha->toString());
	}
	
	function testFirstPatternStringOperatorNumberFirstOperandShouldBeTwo(){
		$myCaptcha = new Captcha(1,2,1,1);
		$this->assertEquals("Two",$myCaptcha->getFirstOperand());
	}
	
	function testFirstPatternStringOperatorNumberFirstOperandShouldBeThree(){
		$myCaptcha = new Captcha(1,3,1,1);
		$this->assertEquals("Three",$myCaptcha->getFirstOperand());
	}
	
	function testFirstPatternStringOperatorNumberFirstOperandShouldBeNine(){
		$myCaptcha = new Captcha(1,9,1,1);
		$this->assertEquals("Nine",$myCaptcha->getFirstOperand());
	}
	
	function testFirstOperatorShouldBePlus(){
		$myCaptcha = new Captcha(1,1,1,1);
		$this->assertEquals("+",$myCaptcha->getOperator());
	}
	
	function testSecondOperatorShouldBeStar(){
		$myCaptcha = new Captcha(1,1,2,1);
		$this->assertEquals("*",$myCaptcha->getOperator());
	}
	
	function testSecondOperatorShouldBeMinus(){
		$myCaptcha = new Captcha(1,1,3,1);
		$this->assertEquals("-",$myCaptcha->getOperator());
	}
	
	function testSecondPatternNumberOperatorStringSecondOperandShouldBeOne(){
		$myCaptcha = new Captcha(1,1,1,1);
		$this->assertEquals("One",$myCaptcha->getSecondOperand());
	}
	
	function testSecondPatternNumberOperatorStringSecondOperandShouldBeTwo(){
		$myCaptcha = new Captcha(1,1,1,2);
		$this->assertEquals("Two",$myCaptcha->getSecondOperand());
	}
	
	function testSecondPatternNumberOperatorString(){
		$myCaptcha = new Captcha(2,1,1,1);
		$this->assertEquals("1 + One",$myCaptcha->ToString());
	}
	
	function testSecondPatternStringOperatorNumberBySecondOperandIsTwo(){
		$myCaptcha = new Captcha(2,1,1,2);
		$this->assertEquals("1 + Two",$myCaptcha->ToString());
	}
	
	function testSecondPatternStringOperatorNumberByFirstOperandIsFive(){
		$myCaptcha = new Captcha(2,5,1,2);
		$this->assertEquals("5 + Two",$myCaptcha->ToString());
	}
	
	function testSecondPatternStringOperatorNumberByOperatorIsThree(){
		$myCaptcha = new Captcha(2,5,3,2);
		$this->assertEquals("5 - Two",$myCaptcha->ToString());
	}
	
	function testFirstPatternStringOperatorNumberByOperatorIsThree(){
		$myCaptcha = new Captcha(1,5,3,2);
		$this->assertEquals("Five - 2",$myCaptcha->ToString());
	}

	function testGetResultByOperatorIsPlus(){
		$myCaptcha = new Captcha(1,5,1,2);
		$this->assertEquals(7,$myCaptcha->GetResult());
	}
	
	function testGetResultByOperatorIsPlusAndSencondOperandIsSeven(){
		$myCaptcha = new Captcha(1,5,1,7);
		$this->assertEquals(12,$myCaptcha->GetResult());
	}
	
	function testGetResultByOperatorIsMultipleAndSencondOperandIsSeven(){
		$myCaptcha = new Captcha(1,5,2,7);
		$this->assertEquals(35,$myCaptcha->GetResult());
	}
	
	function testGetResultByOperatorIsMinus(){
		$myCaptcha = new Captcha(1,9,3,7);
		$this->assertEquals(2,$myCaptcha->GetResult());
	}
}
