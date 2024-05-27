<?php

namespace App;

use Carbon\Carbon;
use Symfony\Component\Stopwatch\Stopwatch;

class User
{
    private array $animals;
    private Carbon $currentDate;
    private Stopwatch $stopwatch;

    public function __construct(array $animals)
    {
        $this->animals = $animals;
        $this->currentDate = Carbon::now();
        $this->stopwatch = new Stopwatch();
    }

    public function display(): void
    {
        echo "Current date: " . $this->currentDate->toFormattedDateString() . PHP_EOL;
        echo "________________________" . PHP_EOL;
        foreach ($this->animals as $animal) {
            echo "animal: {$animal->getName()}
happiness: {$animal->getHappiness()}
favorite: {$animal->getFavFood()}
reserves: {$animal->getReserves()}
________________________" . PHP_EOL;
        }
    }

    private function update(int $rounds, string $excludeAnimal): void
    {
        foreach ($this->animals as $animal) {
            if ($animal->getName() !== $excludeAnimal) {
                for ($i = 0; $i < $rounds; $i++) {
                    $animal->work();
                }
            }
        }
    }

    private function findAnimal(string $name): ?Animal
    {
        foreach ($this->animals as $animal) {
            if ($animal->getName() === $name) {
                return $animal;
            }
        }
        return null;
    }

    public function addDay(int $days): void
    {
        $this->currentDate->addDays($days);
    }

    public function interact(): void
    {
        while (true) {
            echo "Actions:|play|feed|pet|status|exit|" . PHP_EOL;
            $action = trim(strtolower(readline()));
            if ($action === "exit") {
                exit("Goodbye");
            }
            if ($action === "status") {
                $this->display();
                continue;
            }
            $animalName = trim(strtolower(readline("Enter animal: ")));
            $animal = $this->findAnimal($animalName);
            if ($animal === null) {
                echo "Animal not found" . PHP_EOL;
                continue;
            }
            switch ($action) {
                case "play":
                    $rounds = (int)readline("Enter number of rounds: ");
                    if ($rounds < 3) {
                        echo "Incorrect amount " . PHP_EOL;
                    } else {
                        $this->stopwatch->start('play');
                        for ($i = 0; $i < $rounds; $i++) {
                            $animal->play();
                            $this->update(1, $animal->getName());
                        }
                        $this->addDay($rounds);
                        $event = $this->stopwatch->stop('play');
                        echo "Action took $event ms" . PHP_EOL;
                    }
                    break;
                case "feed":
                    $food = trim(strtolower(readline("Enter food: ")));
                    $this->stopwatch->start('feed');
                    $animal->feed($food);
                    $this->update(5, $animal->getName());
                    $this->addDay(1);
                    $event = $this->stopwatch->stop('feed');
                    echo "Action took $event ms" . PHP_EOL;
                    break;
                case "pet":
                    $this->stopwatch->start('pet');
                    $animal->pet();
                    $event = $this->stopwatch->stop('pet');
                    echo "Action took $event ms" . PHP_EOL;
                    break;
                default:
                    echo "invalid action" . PHP_EOL . PHP_EOL;
            }
            $this->display();
        }
    }
}