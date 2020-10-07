<?php 

class Fruit {
  // Properties
  public $name;
  public $color;

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
}

$var = new Fruit();
$var->set_name('Apple');

echo $var->name;
 ?>