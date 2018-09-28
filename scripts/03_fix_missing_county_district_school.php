<?php

require_once(__DIR__ . '/../bootstrap.php');

#NOT EMPTY ROWS
$notEmptyResults = $RawDataService->findRowsWithNoEmptyValues();
$notEmpty = [];

foreach($notEmptyResults as $row)
{
  $notEmpty[$row['CDS_CODE']] = $row;
}

# EMPTY ROWS
$emptyResults = $RawDataService->findRowsWithEmptyValues();
$isEmpty = [];

foreach($emptyResults as $row)
{
  $isEmpty[$row['CDS_CODE']] = $row;
}

# INSERT
foreach($isEmpty as $cds_code=>$emptySet)
{
  if(isset($notEmpty[$cds_code]))
  {
    $info = $notEmpty[$cds_code];
    $success = $RawDataService->updateRowsWithEmptyValues($cds_code, $info);
  }
  else
  {
    print "DOES NOT EXIST!!! $cds_code\n";
  }

}

