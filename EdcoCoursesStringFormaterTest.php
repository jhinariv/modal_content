<?php

use PHPUnit\Framework\TestCase;

define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '\includes\bootstrap.inc';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

// Bootstrap Drupal.
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

class EdcoCoursesStringFormaterTest extends TestCase {

  public function testCourseProcessGetImplodestring() {
    $val = 25000;
    $result = _course_process_get_price_formated($val);
    $this->assertEquals("$25,000", $result);

    $val = '0';
    $result = _course_process_get_price_formated($val);
    $this->assertEquals($result, "$0");
  }

}
