<?php

require_once('db.php');
require_once('lib.php');

class ParseEnrollmentFile {

  private $data = [];
  private $fileName = '';
  private $headers = [];
  private $year;

  public static $formatYears = array(
    "2017" => "2013",
    "2016" => "2013",
    "2015" => "2013",
    "2014" => "2013",
    "2013" => "2013",
    "2012" =>  "2013",
    "2011" => "2013",
    "2010" => "2013",
    "2009" => "2013",
    "2008" => "2013",
    "2007" => "2013",
    "2006" => "2008",
    "2005" => "2008",
    "2004" => "2008",
    "2003" => "2008",
    "2002" => "2008",
    "2001" => "2008",
    "2000" => "2008",
    "1999" => "2008",
    "1998" => "2008",
    "1997" => "1997",
    "1996" => "1997",
    "1995" => "1997",
    "1994" => "1997",
    "1993" => "1997",
    );

  public static $yearToFilename = array(
    "2017" => "2017-18",
    "2016" => "2016-17",
    "2015" => "2015-16",
    "2014" => "2014-15",
    "2013" => "2013-14",
    "2012" => "2012-13",
    "2011" => "2011-12",
    "2010" => "2010-11",
    "2009" => "2009-10",
    "2008" => "2008-09",
    "2007" => "2007-08",
    "2006" => "0607",
    "2005" => "0506",
    "2004" => "0405",
    "2003" => "0304",
    "2002" => "0203",
    "2001" => "0102",
    "2000" => "0001",
    "1999" => "9900",
    "1998" => "9899",
    "1997" => "9798",
    "1996" => "9697",
    "1995" => "9596",
    "1994" => "9495",
    "1993" => "9394",
  );

  public function __construct($year)
  {
    $this->year = $year;
    $this->fileName = 'data/' . self::$yearToFilename[$year] . '.txt';
    $this->loadFile();
  }

  public function loadFile()
  {
    if(file_exists($this->fileName))
    {
      $fileContents = file($this->fileName);

      $this->headers = array_map('trim', explode("\t", $fileContents[0]));
      unset($fileContents[0]);

      foreach($fileContents as $line)
      {
        $bits = explode("\t", trim($line));
        $this->data[] = array_combine($this->headers, $bits);
      }
    }
    #print_r($this->data);
  }

  public static function getFormatFromYear($year)
  {
    return self::$formatYears[$year];
  }

  public function parseData()
  {
    if (self::$formatYears[$this->year] == '2013') {
      print "Parse: 2013\n";

      foreach ($this->data as $row) {
        $grades = array_slice($row,6);

        $grade_array = array();
        foreach($grades as $index=>$student_number) {
            $grade_array[$index] = $student_number;
        }

        if (is_array($data[$row['COUNTY']][$row['DISTRICT']][$row['SCHOOL']])) {
            $add = function($a, $b) { return $a + $b; };

            $summedArray = array_map($add, $data[$row['COUNTY']][$row['DISTRICT']][$row['SCHOOL']], $grade_array);

            $data[$row['COUNTY']][$row['DISTRICT']][$row['SCHOOL']] = array_combine(array_keys($grade_array), $summedArray);
        }
        else {
            $data[$row['COUNTY']][$row['DISTRICT']][$row['SCHOOL']] = $grade_array;
        }
      }
    }
    elseif (self::$formatYears[$this->year] == '2008')
    {
      print "Parse 2008\n";
    }
    elseif (self::$formatYears[$this->year] == '1997')
    {
      print "Parse 1997\n";
    }
    else
    {
      print "WTF!!!"; exit;
    }

    print_r($grade_array);
    print_r($data);
    exit;
    return array($grade_array,$data);
  }
}

$db = new DBSql();

# loop through the filename years and grab the content files
foreach (ParseEnrollmentFile::$yearToFilename as $year=>$filename)
{
  print "Year: $year | FileName: $filename\n";
  #print "Format: " . ParseEnrollmentFile::getFormatFromYear($year);

  if(ParseEnrollmentFile::getFormatFromYear($year) == '2013')
  {
    $contents = file('data/' . $filename. '.txt');
    $header = explode("\t", $contents[0]);
    unset($contents[0]);
    foreach($contents as $line)
    {
      $values = explode("\t", trim($line));
      $values = array_map('addslashes', $values);
      $insert = "INSERT INTO EnrollmentRawData (YEAR," . join(',', $header) . ") VALUES ('$year', '" . join("','", $values) . "');\n";

      try
      {
        $db->runQuery($insert);
      }
      catch (Exception $e) {
        print 'Caught exception: ' .  $e->getMessage() . "\n";
      }
    }
    print "\n";
  }

  if(ParseEnrollmentFile::getFormatFromYear($year) == '2008')
  {
    $contents = file('data/' . $filename. '.txt');
    $header = explode("\t", $contents[0]);
    unset($contents[0]);
    foreach($contents as $line)
    {
      $values = explode("\t", trim($line));
      $values = array_map('addslashes', $values);
      $insert = "INSERT INTO EnrollmentRawData (YEAR," . join(',', $header) . ") VALUES ('$year', '" . join("','", $values) . "');\n";

      try
      {
        $db->runQuery($insert);
      }
      catch (Exception $e) {
        print 'Caught exception: ' .  $e->getMessage() . "\n";
      }
    }
    print "\n";
  }

  if(ParseEnrollmentFile::getFormatFromYear($year) == '1997')
  {
    $contents = file('data/' . $filename. '.txt');
    $header = explode("\t", $contents[0]);
    unset($contents[0]);
    foreach($contents as $line)
    {
      $values = explode("\t", trim($line));
      $values = array_map('addslashes', $values);
      $insert = "INSERT INTO EnrollmentRawData (YEAR," . join(',', $header) . ") VALUES ('$year', '" . join("','", $values) . "');\n";

      try
      {
        $db->runQuery($insert);
      }
      catch (Exception $e) {
        print 'Caught exception: ' .  $e->getMessage() . "\n";
      }
    }
    print "\n";
  }

}


