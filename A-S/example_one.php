<?php
###########################################
## SINGLE RESPONSIBILITY PRINCIPLE (SRP) ##
###########################################
class Json
{
    /**
     * Convert data in json format
     * @param $data
     * @return false|string
     */
    public static function from($data)
    {
        return json_encode($data);
    }
}

class UserRequest
{
    protected static $rules = [
        'name' => 'string',
        'email' => 'string',
    ];

    /**
     * Validate value/property type
     * @param $data
     * @return void
     * @throws Exception
     */
    public static function validate($data)
    {
        foreach ($data as $property => $value) {

            if (gettype($value) !== static::$rules[$property])
                throw new \Exception("User Property {$property} Must Be of Type".static::$rules[$property]);
        }
    }
}

class User
{
    public $name;
    public $email;

    /**
     * Assign value to those properties
     * @param $data
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }
}

// Sample data in array format
$data = ['name' => 'Razu','email' => 'razu@gmail.com'];

// Validate data
UserRequest::validate($data);

// User instance created
$user = new User($data);

// Convert user data to json and echo
echo (Json::from($user));



