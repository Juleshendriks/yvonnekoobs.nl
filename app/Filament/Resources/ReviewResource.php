<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Beoordelingen';
    protected static ?string $pluralModelLabel = 'Beoordelingen';
    protected static ?string $modelLabel = 'Beoordeling';

    protected static ?string $navigationGroup = 'content';
    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Persoonlijke informatie')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Naam')
                            ->required(),
                        Forms\Components\TextInput::make('company')
                            ->label('Bedrijf')
                            ->placeholder('Optioneel'),
                        Forms\Components\TextInput::make('position')
                            ->label('Functie')
                            ->placeholder('Optioneel'),
                    ]),

                Forms\Components\Section::make('Beoordeling')
                    ->schema([
                        Forms\Components\Textarea::make('review')
                            ->label('Review')
                            ->rows(6)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('rating')
                            ->label('Beoordeling (1-5)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(5)
                            ->default(5)
                            ->required(),
                    ]),

                Forms\Components\Section::make('Extra opties')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('avatar')->label('Avatar')->image()->imageEditor(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actief')
                            ->default(true)
                            ->required(),
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
                Tables\Columns\TextColumn::make('company')
                    ->label('Bedrijf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Functie')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Beoordeling')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->rounded()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Uitgelicht')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actief')
                    ->boolean(),
//                Tables\Columns\TextColumn::make('sort_order')
//                    ->label('Sorteervolgorde')
//                    ->numeric()
//                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt op')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Bijgewerkt op')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Bewerken'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Verwijder selectie'),
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/nieuw'),
            'edit' => Pages\EditReview::route('/{record}/bewerken'),
        ];
    }
}
