<?php
###########################################
### Liskov Substitution Principle (LSP) ###
###########################################
interface CoffeeMachineInterface {
    public function brewCoffee($selection);
}

class BasicCoffeeMachine implements CoffeeMachineInterface {

    /**
     * Check coffee type and call this func
     * @param $selection
     * @return null
     * @throws Exception
     */
    public function brewCoffee($selection) {
        switch ($selection) {
            case 'ESPRESSO':
                return $this->brewEspresso();
            default:
                throw new Exception('Selection not supported');
        }
    }

    /**
     * Serve expresso coffee
     * @return void
     */
    protected function brewEspresso() {
        echo "Expresso Coffee Served";
    }
}

class PremiumCoffeeMachine extends BasicCoffeeMachine {

    /**
     * Check coffee type and call this func
     * @param $selection
     * @return null
     * @throws Exception
     */
    public function brewCoffee($selection) {
        switch ($selection) {
            case 'ESPRESSO':
                return $this->brewEspresso();
            case 'VANILLA':
                return $this->brewVanillaCoffee();
            default:
                throw new Exception('Selection not supported');
        }
    }

    /**
     * Serve vanilla coffee
     * @return void
     */
    protected function brewVanillaCoffee() {
        echo "Vanilla Coffee Made";
    }
}

/**
 * Check coffee type and create this type was instance
 * @param $plan
 * @return BasicCoffeeMachine|PremiumCoffeeMachine
 */
function getCoffeeMachine($plan) {
    switch ($plan) {
        case 'PREMIUM':
            return new PremiumCoffeeMachine();
        case 'BASIC':
        default:
            return new BasicCoffeeMachine();
    }
}

/**
 * Plan & coffee type was coffee prepare
 * @param $plan
 * @param $selection
 * @return null
 * @throws Exception
 */
function prepareCoffee($plan, $selection) {
    $coffeeMachine = getCoffeeMachine($plan);
    return $coffeeMachine->brewCoffee($selection);
}

// Passed coffee & plan info
prepareCoffee("PREMIUM","VANILLA");

prepareCoffee("BASIC","ESPRESSO");
