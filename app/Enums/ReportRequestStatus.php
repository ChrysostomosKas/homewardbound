<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum ReportRequestStatus implements HasLabel
{
    case Open;
    case Processing;
    case Closed;
    case Rejected;

    public static function all(): array
    {
        return [
            self::Open,
            self::Processing,
            self::Closed,
            self::Rejected
        ];
    }
    public function name(): string
    {
        return match ($this) {
            self::Open => 'Ανοιχτή',
            self::Processing => 'Επεξεργασία',
            self::Closed => 'Κλειστή',
            self::Rejected => 'Απορρίφθηκε'
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Open => 'Open',
            self::Closed => 'Closed',
            self::Processing => 'Processing',
            self::Rejected => 'Rejected',
            default => '',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Open => 'check',
            self::Closed => 'x',
            self::Rejected => 'folder-cancel',
            self::Processing => 'dots'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Open  => 'gray',
            self::Processing  => 'yellow',
            self::Closed => 'green',
            self::Rejected => 'red',
        };
    }
}
