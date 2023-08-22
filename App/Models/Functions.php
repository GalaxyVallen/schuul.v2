<?php
namespace ev\Models;

class Functions
{
  public static function getClass(float $data)
  {
    if ($data >= 90) {
      return 'text-green-600';
    } elseif ($data >= 82) {
      return 'text-yellow-500';
    } else {
      return 'text-red-600';
    }
  }
}
