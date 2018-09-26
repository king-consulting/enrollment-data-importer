<?php

ini_set('memory_limit','1G');
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 

#date_default_timezone_set('America/Los_Angeles');

$formatYears = array(
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

$ethnic2013 = array(
  "0" => "Not reported",
  "1" => "American Indian or Alaska Native",
  "2" => "Asian",
  "3" => "Pacific Islander",
  "4" => "Filipino",
  "5" => "Hispanic or Latino",
  "6" => "African American",
  "7" => "White",
  "9" => "Two or More Races",
);

$ethnic2008 = array(
  "1" => "American Indian or Alaska Native",
  "2" => "Asian",
  "3" => "Pacific Islander",
  "4" => "Filipino",
  "5" => "Hispanic or Latino",
  "6" => "African American",
  "7" => "White, not Hispanic",
  "8" => "Multiple or No Response",
);

$ethnic1997 = array(
  "1" => "American Indian or Alaska Native",
  "2" => "Asian",
  "3" => "Pacific Islander",
  "4" => "Filipino",
  "5" => "Hispanic or Latino",
  "6" => "African American",
  "7" => "White",
);

$yearsFileNames = array(
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

