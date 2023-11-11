<?php

namespace App\Enums;

enum PetCategory: string
{
    case Dog = 'Dog';
    case Cat = 'Cat';
    case Bird = 'Bird';
    case Fish = 'Fish';
    case Rabbit = 'Rabbit';
    case Hamster = 'Hamster';
    case Reptile = 'Reptile';
    case Amphibian = 'Amphibian';
    case Horse = 'Horse';
    case Other = 'Other';

    public function name(): string
    {
        return match ($this) {
            self::Dog => 'Σκύλος',
            self::Cat => 'Γάτα',
            self::Bird => 'Πτηνό',
            self::Fish => 'Ψάρι',
            self::Rabbit => 'Κουνέλι',
            self::Hamster => 'Χάμστερ',
            self::Reptile => 'Ερπετό',
            self::Amphibian => 'Αμφίβιο',
            self::Horse => 'Άλογο',
            self::Other => 'Άλλο'
        };
    }
}
