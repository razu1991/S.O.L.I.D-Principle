<?php
###########################################
###### OPEN/CLOSED PRINCIPLE (OCP) ######
###########################################
interface Shape
{
    /**
     * Calculate area
     * @return mixed
     */
    public function area();
}

class Square implements Shape
{
    public $height;
    public $width;

    /**
     * Assign height & weight value
     * @param $height
     * @param $width
     */
    public function __construct($height, $width)
    {
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Calculate square area
     * @return float|int
     */
    public function area()
    {
        return $this->width * $this->height;
    }
}

class Circle implements Shape
{
    public $radius;

    /**
     * Assign radius value
     * @param $radius
     */
    public function __construct($radius)
    {
        $this->radius = $radius;
    }

    /**
     * Calculate circle area
     * @return float|int
     */
    public function area()
    {
        return pi() * ($this->radius * $this->radius);
    }
}


class Triangle implements Shape
{
    public $base;
    public $height;

    /**
     * Assign base & height value
     * @param $base
     * @param $height
     */
    public function __construct($base, $height)
    {
        $this->base = $base;
        $this->height = $height;
    }

    /**
     * Calculate triangle area
     * @return float|int
     */
    public function area()
    {
        return ($this->height * $this->base) / 2;
    }
}

class AreaCalculator
{
    public $area;

    /**
     * Calculate is a higher class function call dependent call area func
     * @param Shape $shape
     * @return mixed
     */
    public function calculate(Shape $shape)
    {
        return $this->area = $shape->area();
    }
}

// Create instance
$areaCalculator = new AreaCalculator();

// Instantiate and echo area value
$square = new Square(5, 3);
echo($areaCalculator->calculate($square));
echo "<br>";
// Instantiate and echo area value
$circle = new Circle(5);
echo($areaCalculator->calculate($circle));
echo "<br>";
// Instantiate and echo area value
$triangle = new Triangle(5, 3);
echo($areaCalculator->calculate($triangle));