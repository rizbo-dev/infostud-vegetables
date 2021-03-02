<?php

use JetBrains\PhpStorm\Pure;

class Vegetable implements IModel
{
    private Database $db;



    public function __construct()
    {
        $this->connectToDb();
    }

    public function connectToDb(): void
    {
        $dbConfig = new DatabaseConfiguration('localhost','root','','pijaca',[
            PDO::ATTR_PERSISTENT => true ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_OBJ
        ]);

        $this->db = new Database($dbConfig);
    }

    #[Pure] public function getNameOfModel(): string
    {
        return get_class($this);
    }

    public function getVegetables(): array
    {
        $this->db->query("SELECT * FROM povrce");

        return $this->db->getResults();
    }

    public function getVegetable(int $id)
    {
        $this->db->query("SELECT * FROM povrce where id = :id");
        $this->db->bind(":id",$id);
        return $this->db->getResult();
    }
    public function getVegetableWithFilterKey($key)
    {
        $this->db->query("SELECT * FROM povrce WHERE name LIKE :toBeSearch");
        $key = "%".$key."%";
        $this->db->bind(":toBeSearch",$key);
        return $this->db->getResults();

    }
    public function insert(VegetableDataMapper $vegetableDataMapper)
    {
        $this->db->query("INSERT INTO povrce (name,price,image) VALUES(:name,:price,:image)");
        $this->db->bind(":name",$vegetableDataMapper->getName());
        $this->db->bind(":price",$vegetableDataMapper->getPrice());
        $this->db->bind(":image",$vegetableDataMapper->getImage());
        if ($this->db->execute())
        {
            return true;
        }

        return false;
    }
}