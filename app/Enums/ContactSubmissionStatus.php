<?php

namespace App\Enums;

enum ContactSubmissionStatus: string
{
    case Nieuw = 'nieuw';
    case InBehandeling = 'in_behandeling';
    case Afgehandeld = 'afgehandeld';
    case Afgewezen = 'afgewezen';

    public function label(): string
    {
        return match ($this) {
            self::Nieuw => 'Nieuw',
            self::InBehandeling => 'In behandeling',
            self::Afgehandeld => 'Afgehandeld',
            self::Afgewezen => 'Afgewezen',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->label()];
        })->toArray();
    }
}
