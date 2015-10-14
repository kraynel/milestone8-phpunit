<?php
namespace Demo;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
	
	public function testAddEmptyString() 
	{
		$a = new Calculator();
		$this->assertEquals(0, $a->Add(""));
	}

	public function testAddOneNumber() 
	{
		$a = new Calculator();
		$this->assertEquals(1, $a->Add("1"));
	}


	public function testAddTwoNumbers() 
	{
		$a = new Calculator();
		$this->assertEquals(3, $a->Add("1,2"));
	}

	public function testCarriageReturnSeparator() 
	{
		$a = new Calculator();
		$this->assertEquals(6, $a->Add("1\n2,3"));
	}

	public function testWithCustomDelimiter()
	{
		// “//[delimiter]\n[numbers…]” for example “//;\n1;2” should return three where the default delimiter is ‘;’.
		$a = new Calculator();
		$this->assertEquals(3, $a->Add("//;\n1;2"));	 
	}

	/**
     * @expectedException        Demo\NegativeNotAllowedException
     * @expectedExceptionMessage negatives not allowed : -3
     */
	public function testNegativeException()
	{
		$a = new Calculator();
		$a->Add("1,2,-3");	 
	}

	/**
     * @expectedException        Demo\NegativeNotAllowedException
     * @expectedExceptionMessage negatives not allowed : -3, -6
     */
	public function testMultipleNegativeException()
	{
		$a = new Calculator();
		$a->Add("1,2,-3,-6");	 
	}

	/**
     * @expectedException        Demo\NegativeNotAllowedException
     * @expectedExceptionMessage negatives not allowed : -3, -6
     */
	public function testMultipleNegativeExceptionWithCustomDelim()
	{
		$a = new Calculator();
		$a->Add("//;\n1;2;-3;-6");
	}

	public function testIgnoreBigNumbers()
	{
		$a = new Calculator();
		$this->assertEquals(2, $a->Add("1001,2")); 
	}

	public function testCustomLengthDelimiters()
	{
		// Delimiters can be of any length with the following format:  
		// “//[delimiter]\n” for example: “//[***]\n1***2***3” should return 6
		$a = new Calculator();
		$this->assertEquals(6, $a->Add("//[***]\n1***2***3")); 
	}

	public function testMultipleDelimiters()
	{
		// Allow multiple delimiters like this:  “//[delim1][delim2]\n” for example “//[*][%]\n1*2%3” should return 6.
		$a = new Calculator();
		$this->assertEquals(6, $a->Add("//[*][%]\n1*2%3")); 
	}

	public function testMultipleLongDelimiters()
	{
		// Allow multiple delimiters like this:  “//[delim1][delim2]\n” for example “//[*][%]\n1*2%3” should return 6.
		$a = new Calculator();
		$this->assertEquals(6, $a->Add("//[!!][%%%]\n1!!2%%%3")); 
	}
}