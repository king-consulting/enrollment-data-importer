<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class DBSql {

  var $conn = null;

  function __construct()
  {
    # mysql+pymysql://root:&$#$JFl23asfjA)8wfLFr29&^@localhost/CaliforniaEnrollment

    $mysqli = new mysqli("localhost", "root", '&$#$JFl23asfjA)8wfLFr29&^', "CaliforniaEnrollment");
    if ($mysqli->connect_errno) {
      echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    #echo $mysqli->host_info . "\n";
    $this->conn = $mysqli;
  }

  function getCounties()
  {
    $res = $this->conn->query("SELECT * FROM Counties ORDER BY name");
    return $res->fetch_all();
  }

  function getDistricts()
  {
    $res = $this->conn->query("SELECT * FROM Districts ORDER BY name");
    return $res->fetch_all();
  }

  function getDistrictsByCounty($id)
  {
    $res = $this->conn->query("SELECT * FROM Districts WHERE county_id = $id ORDER BY name");
    return $res->fetch_all();
  }

  function getSchoolsByDistrictId($id)
  {
    $res = $this->conn->query("SELECT * FROM Schools WHERE district_id = $id ORDER BY name");
    return $res->fetch_all();
  }

  function getSchoolDataBySchoolId($id)
  {
    $res = $this->conn->query("SELECT * FROM SchoolGradeCounts WHERE school_id = $id");
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function getCountsByDistrict($district_id)
  {
    $sql = "SELECT year, sum(kdgn) as kdgn, sum(gr_1) as gr_1, sum(gr_2) as gr_2, 
	sum(gr_3) as gr_3, sum(gr_4) as gr_4, sum(gr_5) as gr_5, 
	sum(gr_6) as gr_6, sum(gr_7) as gr_7, sum(gr_8) as gr_8, 
	sum(gr_9) as gr_9, sum(gr_10) as gr_10, sum(gr_11) as gr_11, sum(gr_12) as gr_12
FROM Schools s
JOIN SchoolGradeCounts gc ON gc.school_id = s.id
WHERE s.district_id = $district_id
GROUP BY year";
    $res = $this->conn->query($sql);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function getDataByDistrictAndYear($district_id, $year)
  {
    $sql = "
SELECT 
  DISTINCT(s.name) as School,
  kdgn as KD, gr_1 as '1st', gr_2 as '2nd',
  gr_3 as '3rd', gr_4 as '4th', gr_5 as '5th',
  gr_6 as '6th', gr_7 as '7th', gr_8 as '8th',
  gr_9 as '9th', gr_10 as '10th', gr_11 as '11th', gr_12 as '12th',
  enr_total as 'Total', ungr_elm as 'Ungr Elem', ungr_sec as 'Ungr Sec',
  adult as 'Adult'
FROM Districts d
JOIN Schools s ON s.district_id = d.id
JOIN SchoolGradeCounts gc ON gc.school_id = s.id AND gc.year = $year
WHERE d.id = $district_id
ORDER BY s.name
    ";
    $res = $this->conn->query($sql);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function getYears()
  {
    $sql ="SELECT DISTINCT year FROM SchoolGradeCounts";
    $res = $this->conn->query($sql);
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function runQuery($query)
  {
    $res = $this->conn->query($query);
    return $res;
  }
}

