<?php

namespace App\Filament\Resources\CoachingTypeResource\Pages;

use App\Filament\Resources\CoachingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCoachingType extends EditRecord
{
    protected static string $resource = CoachingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
