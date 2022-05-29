<?php

// Must require this file in the entry point when using Composer's autoloader:
require 'vendor/autoload.php';
require 'core/bootstrap.php';

use Core\{Router, Request};

Router::load('app/routes.php')->direct(Request::uri(), Request::method());
