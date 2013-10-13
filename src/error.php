<?php
	
	/**
	*  @module global
	*/
	use Logger\Logger;
	
	/**
	*  Convenience function for giving debug error statements.
	*   __This is a global function.__
	*  
	*	error('Something bad happened!');
	*
	*  @class error
	*  @constructor
	*  @param {mixed} object The object to trace
	*/
	function error($object)
	{
	    Logger::instance()->log($object, Logger::ERROR);
	}