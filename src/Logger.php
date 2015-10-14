<?php
namespace Demo;

class Logger implements ILogger
{
	
	public function write($args)
	{
		print $args;
		print "\n";
	}
}