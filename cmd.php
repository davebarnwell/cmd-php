<?php
/**
* Handle common command line jobs
* like parsing cmd line options
*/
class CMD
{
  
  private function __construct() {
    # code...
  }
  
  // parse command line args if nothing is passed in use global $argv
  // a command line of param1 --word=value -k=value -t -mno param2
  // parses as
  // array(8) {
  //   [0]=>
  //   string(6) "param1"
  //   ["word"]=>
  //   string(5) "value"
  //   ["k"]=>
  //   string(5) "value"
  //   ["t"]=>
  //   bool(true)
  //   ["m"]=>
  //   bool(true)
  //   ["n"]=>
  //   bool(true)
  //   ["o"]=>
  //   bool(true)
  //   [1]=>
  //   string(6) "param2"
  // }
  public static function parseArgs($argv=null){
    if ($argv == null) {
      $argv = $GLOBALS['argv'];
    }
    array_shift($argv); // remove script name from front
    $out = array();
    foreach ($argv as $arg){
      // handle options with double hypen followed by multiple characters
      if (substr($arg,0,2) == '--') {
        $eqPos = strpos($arg,'=');
        if ($eqPos === false) {
          // handle --key
          $key = substr($arg,2);
          $out[$key] = isset($out[$key]) ? $out[$key] : true;
        } else {
          // handle --key=value
          $key = substr($arg,2,$eqPos-2);
          $out[$key] = substr($arg,$eqPos+1);
        }
      } else if (substr($arg,0,1) == '-'){
        // handle options with single hyphen followed by one or more characters, each a single option
        if (substr($arg,2,1) == '=') {
          // handle -k=value
          $key = substr($arg,1,1);
          $out[$key] = substr($arg,3);
        } else {
          // handle singfle letter switches -k
          // -kvm is the same as -k -v -m
          $chars = str_split(substr($arg,1));
          foreach ($chars as $char) {
            $key = $char;
            $out[$key] = isset($out[$key]) ? $out[$key] : true;
          }
        }
      } else {
        // it's a string just place it in the next empty numeric array position
        $out[] = $arg;
      }
    }
    return $out;
  }
  
}

?>