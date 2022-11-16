<?php
###########################################
### Liskov Substitution Principle (LSP) ###
###########################################
interface CalculableArea
{
    public function calculateArea();
}

class Rectangle implements CalculableArea
{
    protected $width;
    protected $height;

    /**
     * Assign height & width value
     * @param $width
     * @param $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Calculate rectangle area
     * @return float|int
     */
    public function calculateArea()
    {
        return $this->width * $this->height;
    }
}

class Square implements CalculableArea
{
    protected $edge;

    /**
     * Assign edge value
     * @param $edge
     */
    public function __construct($edge)
    {
        $this->edge = $edge;
    }

    /**
     * Calculate square area
     * @return int
     */
    public function calculateArea()
    {
        return $this->edge ** 2;
    }
}

class AreaCalculator
{
    /**
     * Calculate is a higher class function call dependent call calculateArea func
     * @param CalculableArea $calculableArea
     * @return mixed
     */
    public function calculate(CalculableArea $calculableArea)
    {
        return $calculableArea->calculateArea();
    }
}

// Create instance
$areaCalculator = new AreaCalculator();

// Instantiate & echo rectangle area value
$rectangle = new Rectangle(5,7);
echo $areaCalculator->calculate($rectangle);

// Instantiate & echo square area value
$square = new Square(25);
echo $areaCalculator->calculate($square);
