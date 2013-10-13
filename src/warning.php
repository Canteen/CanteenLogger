<?php
	
	/**
	*  @module global
	*/
	use Canteen\Logger\Logger;
	
	/**
	*  Convenience function for giving debug warning statements. 
	*  __This is a global function.__
	*  
	*	warning('Something serious happened');
	*  
	*  @class warning
	*  @constructor
	*  @param {mixed} object The object to trace
	*/
	function warning($object)
	{
	    Logger::instance()->log($object, Logger::WARNING);
	}