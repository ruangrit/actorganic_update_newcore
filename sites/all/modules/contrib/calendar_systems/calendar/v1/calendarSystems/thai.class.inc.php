<?php

/**
 * 
 */
class cmfcCalendarV1Thai extends cmfcCalendarV1 {
  var $_monthsName = array(
    '1' => 'มกราคม',
    '2' => 'กุมภาพันธ์',
    '3' => 'มีนาคม',
    '4' => 'เมษายน',
    '5' => 'พฤษภาคม',
    '6' => 'มิถุนายน',
    '7' => 'กรกฎาคม',
    '8' => 'สิงหาคม',
    '9' => 'กันยายน',
    '10' => 'ตุลาคม',
    '11' => 'พฤศจิกายน',
    '12' => 'ธันวาคม',
  );
  
  var $_monthsShortName = array(
    '1' => 'ม.ค.',
    '2' => 'ก.พ.',
    '3' => 'มี.ค.',
    '4' => 'เม.ย.',
    '5' => 'พ.ค.',
    '6' => 'มิ.ย.',
    '7' => 'ก.ค.',
    '8' => 'ส.ค.',
    '9' => 'ก.ย.',
    '10' => 'ต.ค.',
    '11' => 'พ.ย.',
    '12' => 'ธ.ค.',
  );
  
  var $_weeksName = array(
    '0' => 'อาทิตย์',
    '1' => 'จันทร์',
    '2' => 'อังคาร',
    '3' => 'พุธ',
    '4' => 'พฤหัสบดี',
    '5' => 'ศุกร์',
    '6' => 'เสาร์',
  );
  
  var $_weeksShortName = array(
    '0' => 'อา',
    '1' => 'จ',
    '2' => 'อ',
    '3' => 'พ',
    '4' => 'พฤ',
    '5' => 'ศ',
    '6' => 'ส',
  );
  
  var $_weekDaysHoliday = array(6, 0);

  function timestampToStr($format, $timestamp = NULL) {
    if (is_null($timestamp)) {
      $timestamp = time(); //$this->phpTime();
    }
    return $this->date($format, $timestamp);
  }
  
  function strToTimestamp($string) {
    $date = explode(' ', $string);
    $date_parts = explode('-', $date[0]);
    $date_parts[0] = $date_parts[0] - 543;
    $date[0] = implode('-', $date_parts);
    $date = implode(' ', $date);
    return strtotime($date);
  }
  
  function timestampToInfoArray($timestamp = NULL) {
    if (is_null($timestamp)) $timestamp = $this->phpTime();
    $info = $this->phpGetDate($timestamp);
    
    $info['month'] = $info['mon'];
    $info['day'] = $info['mday'];
    
    $info['monthName'] = $this->getMonthName($info['month']);
    $info['monthShortName'] = $this->getMonthShortName($info['month']);
    
    $info_timestamp = $this->infoArrayToTimestamp(array(
      'year' => $info['year'],
      'month' => $info['month'],
      'day' => 1,
    ));
    $info['monthFirstDayWeekday'] = $this->phpDate('w', $info_timestamp) + 1;
    $info['monthDaysNumber'] = $this->phpDate('t', $timestamp);
    
    $info['weekday'] = $info['wday'];
    $info['weekdayName'] = $this->getWeekName($info['weekday']);
    $info['weekdayShortName'] = $this->getWeekShortName($info['weekday']);
    
    return $info;
  }
  
  function infoArrayToTimestamp($info) {
    return mktime(0, 0, 0, $info['month'], $info['day'], $info['year']);
  }
  
  function dateDiff($first, $second) {
    $first_date = explode('-', $first);
    $first_date = mktime(0, 0, 0, $first_date[1], $first_date[2], $first_date[0]);
    
    $second_date = explode('-', $second);
    $second_date = mktime(0, 0, 0, $second_date[1], $second_date[2], $second_date[0]);
    
    $totalasec = $second_date - $first_date;
    return $totalday = round($totalsec/86400);
  }
  
  function date($format, $timestamp) {
    if (is_null($timestamp) || $timestamp == '') $timestamp = $this->phpTime();
    $value = gmdate($format, $timestamp);
    switch ($format) {
      case 'D': $output = $this->getWeekShortName(gmdate('w', $timestamp)); break;
      case 'l': $output = $this->getWeekName(gmdate('w', $timestamp)); break;
      case 'S': $output = ''; /* In Thai has no suffix.*/ break;
      case 'F': $output = $this->getMonthName(gmdate('n', $timestamp)); break;
      case 'M': $output = $this->getMonthShortName(gmdate('n', $timestamp)); break;
      case 'Y': $output = $value + 543; break;
      case 'y': 
        $output = (string) $value + 543;
        $output = substr($output, strlen($output) - 2);
      break;
      case 'U': $output = $this->phpTime(); break;
      default: $output = gmdate($format, $timestamp); break;
    }
    return $output;
  }
  
    
  /**
   * translate number of month to name of month
   */
  function getWeekName($weekNumber) {
    return $this->_weeksName[$weekNumber];
  }
      
  function getWeekShortName($weekNumber){   
    return $this->_weeksShortName[$weekNumber];
  }
      
  /**     
   * translate number of month to name of month
   */
  function getMonthName($month) {   
    return $this->_monthsName[$month];
  }
      
  function getMonthShortName($month){   
    return $this->_monthsShortName[$month];
  }   
}
