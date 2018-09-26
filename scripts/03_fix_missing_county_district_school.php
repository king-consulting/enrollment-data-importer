<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli("localhost", "root", '&$#$JFl23asfjA)8wfLFr29&^', "CaliforniaEnrollment");
if ($conn->connect_errno) {
  echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

#NOT NULL ROWS
$sql = 'SELECT DISTINCT CDS_CODE, COUNTY, DISTRICT, SCHOOL FROM EnrollmentRawData WHERE COUNTY IS NOT NULL';

$notNull = [];

try
{
  $res = $conn->query($sql);
  $results = $res->fetch_all(MYSQLI_ASSOC);
  foreach($results as $row)
  {
    $notNull[$row['CDS_CODE']] = $row;
  }
}
catch (Exception $e) {
  print 'Caught exception: ' .  $e->getMessage() . "\n";
}

# NULL ROWS
$sql = 'SELECT DISTINCT CDS_CODE, COUNTY, DISTRICT, SCHOOL FROM EnrollmentRawData WHERE COUNTY IS NULL';

$isNull = [];

try
{
  $res = $conn->query($sql);
  $results = $res->fetch_all(MYSQLI_ASSOC);
  foreach($results as $row)
  {
    $isNull[$row['CDS_CODE']] = $row;
  }
}
catch (Exception $e) {
  print 'Caught exception: ' .  $e->getMessage() . "\n";
}

# INSERT
foreach($isNull as $cds_code=>$emptySet)
{
  if(isset($notNull[$cds_code]))
  {
    $info = $notNull[$cds_code];
    $update = "UPDATE EnrollmentRawData SET COUNTY = '" . addslashes($info['COUNTY']) . "', DISTRICT = '" . addslashes($info['DISTRICT']) . "', SCHOOL = '" . addslashes($info['SCHOOL']) ."' WHERE CDS_CODE = '$cds_code' AND COUNTY IS NULL";

    try
    {
      $conn->query($update);
    }
    catch (Exception $e) {
      print 'Caught exception: ' .  $e->getMessage() . "\n";
    }

  }
  else
  {
    print "DOES NOT EXIST!!! $cds_code\n";
  }
}

