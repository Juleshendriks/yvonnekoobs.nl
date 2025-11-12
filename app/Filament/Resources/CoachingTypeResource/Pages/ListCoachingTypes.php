<?php

namespace App\Filament\Resources\CoachingTypeResource\Pages;

use App\Filament\Resources\CoachingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCoachingTypes extends ListRecords
{
    protected static string $resource = CoachingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
