# Parsing cmd line options from PHP

    php somescript.php --option=option1 --t=options2 -ds param1 param2
    
    in some script it runs
      $args = CMD::parseArgs();
      var_dump($args);

    // parses as
    // array(8) {
    //   [0]=>
    //   string(6) "param1"
    //   [1]=>
    //   string(6) "param2"
    //   ["option"]=>
    //   string(5) "option1"
    //   ["t"]=>
    //   string(5) "option2"
    //   ["d"]=>
    //   bool(true)
    //   ["s"]=>
    //   bool(true)
    // }