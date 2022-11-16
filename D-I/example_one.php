<?php
###########################################
## INTERFACE SEGREGATION PRINCIPLE (ISP) ##
###########################################
interface CarInterface {
    /**
     * Drive method will be used in many classes
     * @return mixed
     */
    public function drive();
}

interface AirplaneInterface {
    /**
     * Fly method will be used in many classes
     * @return mixed
     */
    public function fly();
}

class SmartCar implements CarInterface, AirplaneInterface {

    /**
     * Smart car can drive
     * @return mixed|void
     */
    public function drive() {
        echo 'Driving a smart car!';
    }

    /**
     * Smart car can fly
     * @return mixed|void
     */
    public function fly() {
        echo 'Flying a smart car!';
    }
}

class NormalCar implements CarInterface {

    /**
     * Normal car can drive
     * @return mixed|void
     */
    public function drive() {
        echo 'Driving a normal car!';
    }
}

class Airplane implements AirplaneInterface {

    /**
     * Airplane can fly
     * @return mixed|void
     */
    public function fly() {
        echo 'Flying an airplane!';
    }
}

//Create instance
$smartCar = new SmartCar();

$smartCar->drive();
echo php_sapi_name() == "cli" ?  "\n" : "<br>";

$smartCar->fly();
echo php_sapi_name() == "cli" ?  "\n" : "<br>";

$airplane = new Airplane();
$airplane->fly();
