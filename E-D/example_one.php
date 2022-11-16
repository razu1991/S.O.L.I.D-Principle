<?php
###########################################
## DEPENDENCY INVERSION PRINCIPLE (DIP) ##
###########################################
interface DbConnectionInterface
{
    /**
     * Connect method will be used in many classes
     * @param $host
     * @param $username
     * @param $password
     * @param $dbname
     * @return mixed
     */
    public function connect($host, $username, $password, $dbname);
}

class MySqlConnection implements DbConnectionInterface
{
    protected $connection;
    protected $result;

    /**
     * Mysql connection assigned
     * @param $host
     * @param $username
     * @param $password
     * @param $dbname
     * @return mixed|void
     */
    public function connect($host, $username, $password, $dbname)
    {
        $this->connection = new mysqli($host, $username, $password, $dbname);
    }

    /**
     * Execute mysql query
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $this->result = $this->connection->query($sql);
        return $this->result;
    }
}

class PdoConnection implements DbConnectionInterface
{
    protected $connection;
    protected $result;

    /**
     * Pdo connection assigned
     * @param $host
     * @param $username
     * @param $password
     * @param $dbname
     * @return mixed|void
     */
    public function connect($host, $username, $password, $dbname)
    {
        $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }

    /**
     * Execute PDO query
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $query = $this->connection->prepare($sql);
        $exec = $query->execute();

        if ($query->columnCount() == 0) {
            $this->result = $exec;
        } else {
            $this->result = $query;
        }

        return $this->result;
    }
}

class Database
{
    private $dbConnection;

    /**
     * Assigned database query class
     * @param DbConnectionInterface $dbConnection
     */
    public function __construct(DbConnectionInterface $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    /**
     * Connect database via database classes
     * @param $host
     * @param $username
     * @param $password
     * @param $dbname
     * @return void
     */
    public function connect($host, $username, $password, $dbname)
    {
        $this->dbConnection->connect($host, $username, $password, $dbname);
    }

    /**
     * Pass query and call the execute query func
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        return $this->dbConnection->query($sql);
    }
}

// Create instance
$mysql = new MySqlConnection();

// Passed db instance and perform connect & query
$database = new Database($mysql);
$database->connect("localhost", "root", "", "blog");
$results = $database->query("SELECT * FROM users");

foreach ($results as $result) {
    var_dump($result);
}

