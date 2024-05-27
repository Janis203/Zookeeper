<?php

namespace App;

class Animal
{
    private string $name;
    private int $happiness;
    private string $favFood;
    private int $reserves;

    public function __construct(string $name, int $happiness, string $favFood, int $reserves)
    {
        $this->name = $name;
        $this->happiness = $happiness;
        $this->favFood = $favFood;
        $this->reserves = $reserves;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHappiness(): int
    {
        return $this->happiness;
    }

    public function getFavFood(): string
    {
        return $this->favFood;
    }

    public function getReserves(): int
    {
        return $this->reserves;
    }

    public function play(): void
    {
        $this->happiness += 5;
        $this->reserves -= 5;
    }

    public function work(): void
    {
        $this->happiness -= 10;
        $this->reserves -= 10;
    }

    public function feed($favFood): void
    {
        if ($favFood === $this->favFood) {
            $this->reserves += 50;
        } else {
            $this->reserves -= 100;
            $this->happiness -= 20;
        }
    }

    public function pet(): void
    {
        $this->happiness += 50;
    }
}
