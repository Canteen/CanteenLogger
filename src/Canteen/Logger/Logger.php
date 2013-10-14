<?php

/**
*  @module Canteen\Logger
*/
namespace Canteen\Logger
{	
	/**
	*  Handle the log statements that get outputted when we're running debug mode.
	*  Located in the namespace __Logger__.
	*  @class Logger
	*/
	class Logger
	{	
		/** 
		*  The output string to show
		*  @property {String} traceOutput
		*  @protected
		*/
		protected $traceOutput;

		/** 
		*  The minimum level show
		*  @property {int} minLevel
		*  @protected
		*/
		protected $minLevel;

		/** 
		*  The singleton instance
		*  @property {Logger} instance
		*  @protected
		*  @static
		*/
		static protected $instance;
		
		/** 
		*  If we want to enable this
		*  @property {Boolean} enabled 
		*  @public
		*/
		public $enabled = true;

		/** 
		*  The most general log level, for general message
		*  @property {String} GENERAL
		*  @final
		*  @static
		*/
		const GENERAL = 'GENERAL';
		
		/** 
		*  For logging out info messages
		*  @property {String} GENERAL
		*  @final
		*  @static
		*/
		const INFO = 'INFO';
		
		/** 
		*  For logging out debug messages
		*  @property {String} DEBUG
		*  @final
		*  @static
		*/
		const DEBUG = 'DEBUG';
		
		/** 
		*  For logging out warning messages
		*  @property {String} WARNING
		*  @final
		*  @static
		*/
		const WARNING = 'WARNING';
		
		/** 
		*  For logging out error messages
		*  @property {String} ERROR
		*  @final
		*  @static
		*/
		const ERROR = 'ERROR';

		/**
		*  Build the Logger object
		*/
		protected function __construct()
		{			
			$this->traceOutput = '';
			$this->minLevel = self::GENERAL;
			
			// Active assert and make it quiet
			assert_options(ASSERT_ACTIVE, 1);
			assert_options(ASSERT_WARNING, 0);
			assert_options(ASSERT_QUIET_EVAL, 1);

			// Set up the callback
			assert_options(ASSERT_CALLBACK, array($this, 'assertHandler'));
		}
		
		/**
		*  Handle asserts from PHP
		*  @method assertHandler
		*  @param {String} script The name of the script
		*  @param {int} line The line number
		*  @param {String} message The message of the error
		*/
		public function assertHandler($script, $line, $message)
		{
		    $this->log("Assertion Failed on $script($line) $message", self::ERROR);
		}

		/**
		*  Initialize the singleton for Logger
		*  @method init
		*  @static
		*/
	    public static function init()
	    {
	        if( !isset( self::$instance ) )
	        {
	            $object = __CLASS__;
	            self::$instance = new $object();
	        }
	    }

		/**
		*  Get the single instance of Logger
		*  @method instance
		*  @static
		*  @return {Logger} The singleton instance of Logger
		*/
	    public static function instance()
	    {        
	        return self::$instance;
	    }
		
		/**
		*  Get the logger body content
		*  @method render
		*  @return {String} The output result of the logger, to be added to a page.
		*/
		public function render()
		{
			// If there's no content, don't do anything
			if (!strlen($this->traceOutput)) return;
			
			$style = html('style.logger type=text/css', 
				file_get_contents(str_replace('.php', '.css', __FILE__))
			);
				
			$script = html('script.logger', 
				file_get_contents(str_replace('.php', '.js', __FILE__))
			);
			
			$template = file_get_contents(__DIR__.'/Logger.html');
			return $style . $script . str_replace('{{output}}', $this->traceOutput, $template);
		}

		/**
		*  Set the minimum log level required to show
		*  @method setMinimumLevel
		*  @param {String} level Don't show message with less log level than this
		*/
		public function setMinimumLevel($level)
		{
			$this->minLevel = $level;
		}

		/**
		*  The generic log statement
		*  @method log
		*  @param {mixed} object The object, array or string to log
		*  @param {String} [level='GENERAL'] The level to log at
		*  @param {Boolean} [htmlEntities=true] Convert any html entities to charcodes
		*/
		public function log($object, $level=self::GENERAL, $htmlEntities=true)
		{			
			if (!$this->enabled) return;
			
			$levels = array(
				self::GENERAL, 
				self::INFO,
				self::DEBUG,
				self::WARNING,
				self::ERROR
			);
	
			$c = array_search($level, $levels);
			$m = array_search($this->minLevel, $levels);
			
			// Filter based on the minimum log level
			if ($c && $c < $m) return;
		
			$output = print_r($object, true);
			if ($htmlEntities) $output = htmlentities($output);
			$output .= "\n";
			
			$class = strtolower($level);
			
			$this->traceOutput .= html('pre.'.$class, html('strong', $level.' : '). $output);
		}
	}
}