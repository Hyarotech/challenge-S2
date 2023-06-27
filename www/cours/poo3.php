<?php

interface IntVehicule{
    public function accelerate(): void;
}

//abstract class Vehicle{
class Vehicle implements IntVehicule {
    protected $motor = 1;
    public $color = "red";
    public $speed = 0;

    public function setSpeed(Int $speed): void
    {
        $this->speed = $speed;
    }
    //abstract public function accelerate(): void;
    public function accelerate(): void{}

}

class Car extends Vehicle {
    public $wheel = 4;
    public function accelerate(): void
    {
        $this->speed++;
    }

    public function addMotor(): void
    {
        $this->motor++;
    }
}
class Bike extends Vehicle  {
    public $wheel = 2;
    public function accelerate(): void{
        $this->speed+=2;
    }
}

$myCar = new Car();
$myCar->setSpeed(4);
$myCar->accelerate();

$myCar->addMotor();

var_dump($myCar);