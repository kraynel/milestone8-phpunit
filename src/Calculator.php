<?php
namespace Demo;

class Calculator
{
	const NEGATIVE_NOT_ALLOWED_MSG = "negatives not allowed : ";
	const LIMIT = 1000;

	private function isNegative($var)
	{
		return $var < 0;
	}

	private function isSmallerThanLimit($var)
	{
		return $var <= self::LIMIT;
	}

	private function buildDelimitorRegex($delimitorString)
	{
		$formattedDelimitor = preg_replace('/^\[(.*)\]$/', '\1', $delimitorString);
		$delimitors = explode('][', $formattedDelimitor);
		$cleanedDelimitors = implode ( "|", array_map("preg_quote", $delimitors) );
		
		return "/".$cleanedDelimitors."/";
	}

	public function Add($numbers)
	{
		$delimitor = "/\n|,/";
		if(strrpos($numbers, "//", -strlen($numbers)) !== FALSE)
		{
			//printf("Numbers starts with custom delim\n");
			// Numbers starts with "//"
			list($delimitorTemp, $toSum) = explode("\n", $numbers);

			$delimitor = $this->buildDelimitorRegex(substr($delimitorTemp,2));
		} else {
			$toSum = $numbers;
		}
		
		$intArray = array_map("intval", preg_split($delimitor, $toSum));
		$negativeNumbers = array_filter($intArray, array($this, 'isNegative'));

		if(count($negativeNumbers) > 0)
		{
			throw new NegativeNotAllowedException(self::NEGATIVE_NOT_ALLOWED_MSG.implode ( ", ", $negativeNumbers ));
		}

		$filteredIntArray = array_filter($intArray, array($this, 'isSmallerThanLimit'));
		return array_sum($filteredIntArray);
	}


}