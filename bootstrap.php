<?php

require_once __DIR__ . '/vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use KingConsulting\Service\RawDataService;

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."vendor/king-consulting/enrollment-orm/config/Entity"), $isDevMode);

// the connection configuration
$conn = array(
  'driver'   => 'pdo_mysql',
  'user'     => 'root',
  'password' => '&$#$JFl23asfjA)8wfLFr29&^',
  'dbname'   => 'Enrollment',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);

$RawDataService = new RawDataService($entityManager);


