#!/usr/bin/env php
<?php
// application.php

require __DIR__ . '/vendor/autoload.php';

use LegacyApp\Command\LegacyDatabaseChangeListenerCommand;
use Symfony\Component\Console\Application;

$application = new Application();


$application->add(new LegacyDatabaseChangeListenerCommand());

$application->run();