<?php
class A{
    private static int $count = 0;

    public function __construct(){
        self::$count++; 
    }

    public static function affiche(){
        return self::$count;
    }
}

$z = new A();
$b = new A();
$k = new A();
echo A::affiche();

