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
    $update = "UPDATE EnrollmentRawData SET COUNTY = '" . addslashes($info['COUNTY']) . "', DISTRICT = '" . addslashes($info['DISTRICT']) . "', SCHOOL = '" . addslashes($info['SCHOOL']) ."' WHERE CDS_CODE = '$cds_code' AND COUNTY = ''";
    print $update."\n";

/*
    try
    {
      $conn->query($update);
    }
    catch (Exception $e) {
      print 'Caught exception: ' .  $e->getMessage() . "\n";
    }
*/
  }
  else
  {
    print "DOES NOT EXIST!!! $cds_code\n";
  }

}

