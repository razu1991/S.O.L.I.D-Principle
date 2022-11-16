<?php
###########################################
## INTERFACE SEGREGATION PRINCIPLE (ISP) ##
###########################################
interface Animal
{
    /**
     * Feed method will be used in many classes
     * @return mixed
     */
    public function feed();
}

interface Pet extends Animal
{
    /**
     * Faithfull method will be used in many classes
     * @return mixed
     */
    public function faithfull();
}

class Dog implements Pet
{
    /**
     * Dog is faithfull
     * @return mixed|void
     */
    public function faithfull()
    {
        echo "Dog is faithfull pet";
    }

    /**
     * Feed the dog
     * @return mixed|void
     */
    public function feed()
    {
       echo "The dog must be fed";
    }
}

class Tiger implements Animal
{
    /**
     * Tiger hunt and eat deer
     * @return mixed|void
     */
    public function feed()
    {
        echo "Tigers hunt and eat deer";
    }
}

// Create instance
$dog = new Dog();
$dog->faithfull();
echo php_sapi_name() == "cli" ?  "\n" : "<br>";
$dog->feed();
echo php_sapi_name() == "cli" ?  "\n" : "<br>";
$tiger = new Tiger();
$tiger->feed();


