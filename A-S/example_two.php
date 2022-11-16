<?php
###########################################
## SINGLE RESPONSIBILITY PRINCIPLE (SRP) ##
###########################################
interface ILog
{
    /**
     * @param $type
     * @return mixed
     */
    public function add($type);

    /**
     * @param $dimiliter
     * @return mixed
     */
    public function toString($dimiliter);

}

class DepositLog implements ILog
{
    private $depositLogs = [];

    /**
     * Add deposit log in array
     * @param $deposit
     * @return mixed|void
     */
    public function add($deposit)
    {
        $now = new DateTime();
        $date = $now->format("Y-m-d h:i:s.u");
        $this->depositLogs[] = $date . " : " . $deposit;
    }

    /**
     * Convert arrays to string
     * @param $dimiliter
     * @return mixed|string
     */
    public function toString($dimiliter = ", ")
    {
        if (empty($this->depositLogs)) {
            return "No Deposit logs";
        }
        return implode($this->depositLogs, $dimiliter);

    }
}

class WithdrawLog implements ILog
{
    private $withdrawLogs = [];

    /**
     * Add withdraw log in array
     * @param $withdraw
     * @return mixed|void
     */
    public function add($withdraw)
    {
        $now = new DateTime();
        $date = $now->format("Y-m-d h:i:s.u");
        $this->withdrawLogs[] = $date . " : " . $withdraw;
    }

    /**
     * Convert arrays to string
     * @param $dimiliter
     * @return mixed|string
     */
    public function toString($dimiliter = ", ")
    {
        if (empty($this->withdrawLogs)) {
            return "No Withdraw logs";
        }
        return implode($this->withdrawLogs, $dimiliter);

    }
}

class Logger
{
    protected $log;

    /**
     * Assign dependent class when initiated
     * @param ILog $ILog
     */
    public function __construct(ILog $ILog)
    {
        $this->log = $ILog;
    }


    /**
     * Call dependent class add method
     * @param $logType
     * @return mixed
     */
    public function add($logType)
    {
        return $this->log->add($logType);
    }

    /**
     * Call dependent class toString method
     * @param $dimiliter
     * @return mixed
     */
    public function toString($dimiliter = ", ")
    {
        return $this->log->toString($dimiliter = ", ");
    }
}

class LogStorage
{
    private $fileName;

    /**
     * Assign log type wise filename
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Create file and store all log data
     * @param $text
     * @return void
     */
    public function save($text)
    {
        $fp = fopen($this->fileName, "w");
        fwrite($fp, $text);
        fclose($fp);
    }
}

$depositLog = new DepositLog();
$logger = new Logger($depositLog);
$logger->add("First Deposit Log");
$logger->add("Second Deposit Log");
$depositLogStorage = new LogStorage("deposit_log.txt");
$depositLogStorage->save($logger->toString("\n"));

$withdrawLog = new WithdrawLog();
$logger = new Logger($withdrawLog);
$logger->add("First Withdraw Log");
$logger->add("Second Withdraw Log");
$withdrawLogStorage = new LogStorage("withdraw_log.txt");
$withdrawLogStorage->save($logger->toString("\n"));


