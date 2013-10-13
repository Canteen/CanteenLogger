<?php
	
	/**
	*  @module global
	*/
	use Logger\Logger;

	/**
	*  Convenience function for giving debug trace statements.
	*   __This is a global function.__
	*  
	*	debug('Checking something out!');
	*
	*  @class debug
	*  @constructor
	*  @param {mixed} object The object to debug in the Logger
	*/
	function debug($object)
	{
	    Logger::instance()->log($object, Logger::DEBUG);
	}