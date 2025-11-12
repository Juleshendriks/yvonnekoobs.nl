<?php

namespace App\Filament\Resources\CoachingTypeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FaqsRelationManager extends RelationManager
{
    protected static string $relationship = 'faqs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->label('Vraag')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('answer')
                    ->label('Antwoord')
                    ->required()
                    ->rows(4),
                Forms\Components\TextInput::make('category')
                    ->label('Categorie')
                    ->maxLength(255),
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
            ->recordTitleAttribute('question')
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Vraag')
                    ->limit(50),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actief')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Volgorde')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('FAQ toevoegen'),
                Tables\Actions\AttachAction::make()->label('Bestaande FAQ koppelen'),
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
