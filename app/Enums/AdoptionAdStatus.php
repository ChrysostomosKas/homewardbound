<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AdoptionAdStatus implements HasLabel
{
    case Open;
    case Closed;
    case Rejected;

    public static function all(): array
    {
        return [
            self::Open,
            self::Closed,
            self::Rejected
        ];
    }
    public function name(): string
    {
        return match ($this) {
            self::Open => 'Ανοιχτή',
            self::Closed => 'Κλειστή',
            self::Rejected => 'Απορρίφθηκε'
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Open => 'Open',
            self::Closed => 'Closed',
            self::Rejected => 'Rejected',
            default => '',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Open => 'check',
            self::Closed => 'x',
            self::Rejected => 'folder-cancel'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Open  => 'yellow',
            self::Closed => 'green',
            self::Rejected => 'red',
        };
    }
}
