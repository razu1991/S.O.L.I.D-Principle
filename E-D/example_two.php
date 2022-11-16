<?php
###########################################
## DEPENDENCY INVERSION PRINCIPLE (DIP) ###
###########################################
interface Employee
{
    /**
     * Calculate bonus method is use in many classes
     * @return mixed
     */
    public function calculateBonus();
}

class PermanentEmploye implements Employee
{
    private $salary;
    private $bonusPercentage;

    /**
     * Set salary
     * @param $salary
     * @return void
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * Set bonus percentage
     * @param $bonusPercentage
     * @return void
     */
    public function setBonusPercentage($bonusPercentage)
    {
        $this->bonusPercentage = $bonusPercentage;
    }

    /**
     * Calculate bonus
     * @return float|int
     */
    public function calculateBonus()
    {
        return ($this->bonusPercentage / 100) * $this->salary;
    }
}

class TemporaryEmployee implements Employee
{
    private $salary;
    private $bonusPercentage;

    /**
     * Set salary
     * @param $salary
     * @return void
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * Set bonus percentage
     * @param $bonusPercentage
     * @return void
     */
    public function setBonusPercentage($bonusPercentage)
    {
        $this->bonusPercentage = $bonusPercentage;
    }

    /**
     * Calculate bonus
     * @return float|int
     */
    public function calculateBonus()
    {
        return ($this->bonusPercentage / 100) * $this->salary;
    }
}

class EmployeeBonus
{
    /**
     * Calculate is a higher class function call dependent classes calculateBonus func
     * @param Employee $employee
     * @return mixed
     */
    public function calculate(Employee $employee)
    {
        return $employee->calculateBonus();
    }
}

// Create instance
$bonusCalculator = new EmployeeBonus();

// Instantiate and calculate & echo permanent employee bonus
$permanentEmployee = new PermanentEmploye();
$permanentEmployee->setSalary(15000);
$permanentEmployee->setBonusPercentage(5);
echo $bonusCalculator->calculate($permanentEmployee);

echo php_sapi_name() == "cli" ?  "\n" : "<br>";

// Instantiate and calculate & echo temporary employee bonus
$temporaryEmployee = new TemporaryEmployee();
$temporaryEmployee->setSalary(10000);
$temporaryEmployee->setBonusPercentage(3);
echo $bonusCalculator->calculate($temporaryEmployee);
