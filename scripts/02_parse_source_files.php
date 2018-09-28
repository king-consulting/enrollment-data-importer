<?php

require_once(__DIR__ . '/../bootstrap.php');

use KingConsulting\SourceFiles\Parser;
$parser = new Parser('/Users/colonel32/github/king-consulting/enrollment-data-importer/data', $RawDataService);
$parser->processFiles();

