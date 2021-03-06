#Canteen Logger

A visual display of logs from within your PHP code. Add this to any dynamic PHP page to see a list of all your debug, trace, info, warning, and error statements. For documentation of the codebase, please see [Canteen Logger docs](http://canteen.github.io/CanteenLogger/).

##Installation

Install is available using [Composer](http://getcomposer.org).

```bash
composer require canteen/logger dev-master
```

Including using the Composer autoloader in your index.

```php
require 'vendor/autoload.php';
```

##Setup

```php
use Canteen\Logger;
Logger.init();
```

At the very end of your PHP code, echo the Logger contents within the body of your document. Such as:

```php
echo Logger::instance()->render();
```

##Usage 

Here are some examples of usage:

```php
// Most general trace statement
trace('Logger setup!');

// You can pass arrays or objects to the trace output
info(array(10, 100, 1000));
```

There are five different log levels function that come with Logger. These are in order from least to most severe. Statements are color coded in the output trace window depending on the method called. 

+ `trace()`
+ `debug()`
+ `info()`
+ `warning()`
+ `error()`

###Rebuild Documentation

This library is auto-documented using [YUIDoc](http://yui.github.io/yuidoc/). To install YUIDoc, run `sudo npm install yuidocjs`. Also, this requires the project [CanteenTheme](http://github.com/Canteen/CanteenTheme) be checked-out along-side this repository. To rebuild the docs, run the ant task from the command-line. 

```bash
ant docs
```

##License##

Copyright (c) 2013 [Matt Karl](http://github.com/bigtimebuddy)

Released under the MIT License.
