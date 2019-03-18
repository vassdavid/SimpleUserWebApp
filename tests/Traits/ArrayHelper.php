<?php
namespace Tests\Traits;

trait ArrayHelper{
  /**
   * Make simple array by key
   * @param  array|object $array input array|object
   * @param  string $key key of array
   * @return array      [description]
   */
  private function makeSimpleArrayByKey($array, $key) {
    $simpleArray = array();
    foreach ($array as $value) {
      $simpleArray[] = "{$value[$key]}";
    }
    return $simpleArray;
  }

  /**
   * test two array items are equal, (order does not matter)
   * @param  array  $array1 input array 1
   * @param  array  $array2 input array 2
   * @return boolean   if equal true else false
   */
  private function arraysHasSameItems(array $array1, array $array2) {
    sort($array1);
    sort($array2);
    return ($array1 == $array2);
  }
}
