<?php

require_once(__DIR__ . '/../bootstrap.php');

use KingConsulting\SourceFiles\Downloader;
$downloader = new Downloader('/Users/colonel32/github/king-consulting/enrollment-data-importer/data');
$downloader->download();

