<?php

ini_set('error_reporting', 0);

require __DIR__.'/../vendor/autoload.php';

$sentryClient = new Raven_Client('https://a05f751d864441cba9c3e710d6df9476@sentry.io/1302553');
$sentryClient->install();

$sentryClient->setRelease('2b779d0714a0d8a1e3f2fb069465c06e5da1901b');

$sentryClient->setEnvironment('dev');
$sentryClient->setEnvironment('preprod');


$logger = new \Monolog\Logger('default', [
    new \Monolog\Handler\RavenHandler($sentryClient)
]);

$user = new \stdClass;
$user->name = 'Vladimir';
$user->birthDate = new \DateTime('1989-03-01');
$user->password = 'test';

function calculate_age(object $user, \DateTime $date): int {
    return null;
    return abs($date->diff($user->birthDate)->y);
}

$logger->info('Hello! I am info log '.calculate_age($user, new \DateTime), [$user]);
