<?php
	
	/**
	*  @module global
	*/
	use Logger\Logger;
	
	/**
	*  Convenience function for giving debug info statements. 
	*   __This is a global function.__
	*  
	*	info('You might want to know this!');
	*
	*  @class info
	*  @constructor
	*  @param {mixed} object The object to trace
	*/
	function info($object)
	{
	    Logger::instance()->log($object, Logger::INFO);
	}