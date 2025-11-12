<?php

namespace App\Filament\Resources;

use App\Enums\ContactSubmissionStatus;
use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Aanvragen';
    protected static ?string $pluralModelLabel = 'Aanvragen';
    protected static ?string $modelLabel = 'Aanvraag';

    protected static ?string $navigationGroup = 'customers';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Afzender')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Naam')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('E-mailadres')
                            ->email()
                            ->required(),
                    ])->columns(2),

                Forms\Components\Fieldset::make('Bericht')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->label('Onderwerp'),
                        Forms\Components\Textarea::make('message')
                            ->label('Bericht')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Fieldset::make('Systeeminfo')
                    ->schema([
                        Forms\Components\TextInput::make('ip_address')
                            ->label('IP-adres')
                            ->disabled(),
                        Forms\Components\Textarea::make('user_agent')
                            ->label('User Agent')
                            ->disabled()
                            ->columnSpanFull(),
                    ])->columns(1),

                Forms\Components\Fieldset::make('Status')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(ContactSubmissionStatus::options())
                            ->required()
                            ->default(ContactSubmissionStatus::Nieuw->value),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Onderwerp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (ContactSubmissionStatus $state) => $state->label())
                    ->color(fn (ContactSubmissionStatus $state) => match ($state) {
                        ContactSubmissionStatus::Nieuw => 'gray',
                        ContactSubmissionStatus::InBehandeling => 'warning',
                        ContactSubmissionStatus::Afgehandeld => 'success',
                        ContactSubmissionStatus::Afgewezen => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ingediend op')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // eventueel statusfilter toevoegen
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Bewerken'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Verwijderen'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'create' => Pages\CreateContactSubmission::route('/create'),
            'edit' => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
