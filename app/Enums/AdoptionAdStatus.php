<?php

namespace App\Enums;

enum AdoptionAdStatus
{
    case Open;
    case Closed;

    public static function all(): array
    {
        return [
            self::Open,
            self::Closed
        ];
    }
    public function name(): string
    {
        return match ($this) {
            self::Open => 'Ανοιχτή',
            self::Closed => 'Κλειστή'
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Open => 'check',
            self::Closed => 'x'
        };
    }
}
