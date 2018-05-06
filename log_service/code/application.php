#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/vendor/autoload.php';

use LoggerApp\Command\UserCreatedLogListenerCommand;
use Symfony\Component\Console\Application;

$application = new Application();


$application->add(new UserCreatedLogListenerCommand());

$application->run();