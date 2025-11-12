<?php

namespace App\Filament\Resources\CoachingTypeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->label('Bedrijf')
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label('Functie')
                    ->maxLength(255),
                Forms\Components\Textarea::make('review')
                    ->label('Review')
                    ->required()
                    ->rows(4),
                Forms\Components\Select::make('rating')
                    ->label('Beoordeling')
                    ->options([
                        1 => '1 ster',
                        2 => '2 sterren',
                        3 => '3 sterren',
                        4 => '4 sterren',
                        5 => '5 sterren',
                    ])
                    ->default(5)
                    ->required(),
                Forms\Components\FileUpload::make('avatar')
                    ->label('Avatar')
                    ->image()
                    ->directory('avatars'),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Uitgelicht'),
                Forms\Components\Toggle::make('is_active')
                    ->label('Actief')
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Sorteervolgorde')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Naam'),
                Tables\Columns\TextColumn::make('company')
                    ->label('Bedrijf'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Beoordeling')
                    ->badge(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Uitgelicht')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actief')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Review toevoegen'),
                Tables\Actions\AttachAction::make()->label('Bestaande review koppelen'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Bewerken'),
                Tables\Actions\DetachAction::make()->label('Ontkoppelen'),
                Tables\Actions\DeleteAction::make()->label('Verwijderen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()->label('Ontkoppelen'),
                    Tables\Actions\DeleteBulkAction::make()->label('Verwijderen'),
                ]),
            ]);
    }
}
