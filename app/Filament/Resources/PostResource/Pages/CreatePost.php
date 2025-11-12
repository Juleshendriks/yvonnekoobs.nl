<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function beforeCreate(): void
    {
        // Als is_published true is, zet published_at op nu
        if ($this->data['is_published'] ?? false) {
            $this->data['published_at'] = Carbon::now();
        }
    }
}
