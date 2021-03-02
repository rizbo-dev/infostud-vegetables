<?php

class Database
{
    private DatabaseConfiguration $configDb;
    private PDO $con;
    private PDOStatement $stmt;
    private $error;

    public function __construct(DatabaseConfiguration $configDb)
    {
        $this->configDb = $configDb;
        $dsn = sprintf("mysql:host=%s;dbname=%s",
            $this->configDb->getHost(),$this->configDb->getDbName());

        try {
            $this->con = new PDO(
                $dsn ,
                $this->configDb->getUser(),
                $this->configDb->getPassword(),
                $this->configDb->getOptions());
        }
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query(string $sql)
    {
        $this->stmt = $this->con->prepare($sql);
    }

    public function bind($param,$value, $type = null)
    {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        $this->stmt->bindValue($param,$value,$type);
    }

    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    public function getResults(): array
    {
        $this->execute();
        return $this->stmt->fetchAll();

    }

    public function getResult()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    public function getRowCount():int
    {
        return $this->stmt->rowCount();
    }
}