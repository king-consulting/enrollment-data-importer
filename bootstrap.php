<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use KingConsulting\Service\RawDataService;
use KingConsulting\Service\CountyService;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."vendor/king-consulting/enrollment-orm/config/Entity"), $isDevMode);

// the connection configuration
$conn = array(
  'driver'   => 'pdo_mysql',
  'user'     => '__USER__',
  'password' => '__PASSWORD__',
  'dbname'   => 'Enrollment',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$RawDataService = new RawDataService($entityManager);
$CountyService = new CountyService($entityManager);

