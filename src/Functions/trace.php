<?php
	
	/**
	*  @module global
	*/
	use Logger\Logger;
	
	/**
	*  Convenience function for giving debug trace statements.  
	*  __This is a global function.__
	*  
	*	trace('Point reached in code!');
	*  
	*  @class trace
	*  @constructor
	*  @param {mixed} object The object to trace
	*  @param {String} [level=Logger::GENERAL] The log level
	*/
	function trace($object, $level=Logger::GENERAL)
	{
	    Logger::instance()->log($object, $level);
	}