<?php

namespace KingConsulting\SourceFiles;

class Parser {

  private $inputDirectory = '';
  private $RawDataService;

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

  public function __construct($inputDirectory, $RawDataService)
  {
    $this->inputDirectory = $inputDirectory;
    $this->RawDataService = $RawDataService;
  }

  public function processFiles()
  {
    # loop through the filename years and grab the content files
    foreach (self::$yearToFilename as $year=>$filename)
    {
      print "Year: $year | FileName: $filename\n";
      $this->insertData($year, $filename);
    }
  }

  public function insertData($year,$filename)
  {
    $contents = file($this->inputDirectory . '/' . $filename. '.txt');
    $header = explode("\t", $contents[0]);
    unset($contents[0]);
    foreach($contents as $line)
    {
      if(!$this->RawDataService->addRow($year, $header, $line))
      {
        print "FAIL: $year, $line\n";
      }
    }
  }
}

