<?php

namespace App\Enums;

enum PetCategory
{
    case Dog;
    case Cat;
    case Bird;
    case Fish;
    case Rabbit;
    case Hamster;
    case Reptile;
    case Amphibian;
    case Horse;
    case Other;
    public static function all(): array
    {
        return [
            self::Dog,
            self::Cat,
            self::Bird,
            self::Fish,
            self::Rabbit,
            self::Hamster,
            self::Reptile,
            self::Amphibian,
            self::Horse,
            self::Other,
        ];
    }
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

    public function icon(): string
    {
        return match ($this) {
            self::Dog => 'dog',
            self::Cat => 'cat',
            self::Bird => 'feather',
            self::Fish => 'fish',
            self::Rabbit => 'carrot',
            self::Hamster => 'mouse',
            self::Reptile => 'planet',
            self::Amphibian => 'confucius',
            self::Horse => 'horse-toy',
            self::Other => 'bookmark-question'
        };
    }

    public static function fromCase(string $case): ?PetCategory
    {
        foreach (self::all() as $petType) {
            if ($petType->name == $case) {
                return $petType;
            }
        }

        return null;
    }
}
