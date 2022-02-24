<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Carbon\Carbon;

if (!function_exists('dd')) {

  function dd($data = null, $cont = true)
  {
    echo "<pre class='offset-3 mt-5'>";
    print_r($data);
    echo "</pre>";
    if (!$cont) {
      die();
    }
  }
}

if (!function_exists('td')) {

  function td($start, $end, $key = null)
  {
    $start = \Carbon\Carbon::parse($start, "Asia/Kolkata");
    $end = \Carbon\Carbon::parse($end, "Asia/Kolkata");
    // echo "<br>";
    // echo "ST: " . $start . "<br>";
    // echo "ED: " . $end . "<br>";
    if ($key == null) {
      echo $end->diffForHumans($start);
    } else {
      echo str_replace(['before', 'after'], '', $end->diffForHumans($start, null, true)) . ' ' . $key;
    }
  }
}

if (!function_exists('tdr')) {

  function tdr($start, $end, $key = null)
  {
    $start = \Carbon\Carbon::parse($start, "Asia/Kolkata");
    $end = \Carbon\Carbon::parse($end, "Asia/Kolkata");
    // echo "<br>";
    // echo "ST: " . $start . "<br>";
    // echo "ED: " . $end . "<br>";
    if ($key == null) {
      return $end->diffForHumans($start);
    } else {
      return str_replace(['before', 'after'], '', $end->diffForHumans($start, null, true)) . ' ' . $key;
    }
  }
}

if (!function_exists('tdn')) {

  function tdn($date, $key = null)
  {
    echo "INPUT:" . $date . "<br>";

    $start = \Carbon\Carbon::parse($date, "Asia/Kolkata")->toDateTimeString();
    $end = \Carbon\Carbon::now("Asia/Kolkata")->toDateTimeString();
    echo "START:" . $start . "<br>";
    echo "END:" . $end . "<br>";
    if ($key == null) {
      echo $end->diffForHumans($start);
    } else {
      echo $end->diffForHumans($start, true) . ' ' . $key;
    }
  }
}


if (!function_exists('ppf')) {

  function ppf($date)
  {
    $now  = \Carbon\Carbon::now("Asia/Kolkata")->toDayDateTimeString();
    $date = \Carbon\Carbon::parse($date);

    echo "Now:" . $now . "<br>";
    echo "Date:" . $date . "<br>";

    if ($now->lt($date)) { // Check Past
      return -1;
    } else if ($date->eq($now)) { //Check Past
      return 0;
    } else if ($date->gt($now)) { // Check Future
      return 1;
    } else {
      return null;
    }
  }
}


if (!function_exists('between')) {

  function between($date, $start, $end)
  {
    $result = \Carbon\Carbon::parse($date)->between($start, $end);

    if ($result) {
      return 1;
    } else {
      return 0;
    }
  }
}

if (!function_exists('isBetween')) {

  function isBetween($date, $start, $end)
  {
    return Carbon::parse($date, "Asia/Kolkata")->between($start, $end) ? true : false;
  }
}

if (!function_exists('rekeyObject')) {
  function rekeyObject($key, $objects)
  {
    $list = [];

    if (!empty($objects)) {
      foreach ($objects as $object) {
        $list[$object->$key] = $object;
      }
    }
    return $list;
  }
}
