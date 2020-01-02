<?php

function deepCompare($a,$b) {
  if(is_object($a) && is_object($b)) {
    if(get_class($a)!==get_class($b))
      return false;
    foreach($a as $key => $val) {
      if(!deepCompare($val,$b->$key))
        return false;
    }
    return true;
  }
  else if(is_array($a) && is_array($b)) {
    while(!is_null(key($a)) && !is_null(key($b))) {
      if (key($a)!==key($b) || !deepCompare(current($a),current($b)))
        return false;
      next($a); next($b);
    }
    return is_null(key($a)) && is_null(key($b));
  }
  else
    return $a===$b;
}

class test {
	
}

$a = new test;
$b = clone $a;
$b->a = 3;

echo (int)($a == $b);



	


