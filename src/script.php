<?php

ini_set('error_reporting', 0);

require __DIR__.'/../vendor/autoload.php';

$sentryClient = new Raven_Client('http://471a12edc4ce4db2bc39d270945a1516@192.168.99.100:9000/2');
$sentryClient->install();

$sentryClient->setRelease('v1.0.0');

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
    return abs($date->diff($user->birthDate)->y);
}

$logger->info('Hello! I am info log '.calculate_age($user, new \DateTime), [$user]);
