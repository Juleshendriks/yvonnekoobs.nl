<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use App\Models\Profile;
use Filament\Actions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class ManageProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ProfileResource::class;

    protected static string $view = 'filament.resources.profile-resource.pages.manage-profile';

    protected static ?string $title = 'Profiel beheren';

    public ?array $data = [];

    public ?Profile $record = null;

    public function mount(): void
    {
        $this->record = Profile::first();

        if ($this->record) {
            $this->fillForm();
        } else {
            $this->form->fill();
        }
    }

    public function fillForm(): void
    {
        $this->form->fill($this->record?->toArray() ?? []);
    }

    public function form(Form $form): Form
    {
        return ProfileResource::form($form)
            ->statePath('data')
            ->model($this->record ?? new Profile());
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Profiel opslaan')
                ->icon('heroicon-o-check')
                ->color('success')
                ->action('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if ($this->record) {
            // Update bestaand profiel
            $this->record->update($data);

            Notification::make()
                ->title('Profiel succesvol bijgewerkt!')
                ->success()
                ->send();
        } else {
            // Maak nieuw profiel aan
            $this->record = Profile::create($data);

            Notification::make()
                ->title('Profiel succesvol aangemaakt!')
                ->success()
                ->send();
        }
    }

    public function getTitle(): string|Htmlable
    {
        return $this->record ? 'Profiel bewerken' : 'Profiel aanmaken';
    }

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label($this->record ? 'Profiel bijwerken' : 'Profiel aanmaken')
                ->submit('save'),
        ];
    }
}
