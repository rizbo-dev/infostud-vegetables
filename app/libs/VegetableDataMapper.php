<?php


class VegetableDataMapper
{
    private string $name;

    private float $price;

    private string $image;

    public function __construct(string $name , float $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }
}