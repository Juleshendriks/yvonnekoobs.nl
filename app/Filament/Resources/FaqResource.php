<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';
    protected static ?string $navigationLabel = 'Veelgestelde vragen';
    protected static ?string $pluralModelLabel = 'Veelgestelde vragen';
    protected static ?string $modelLabel = 'Vraag';

    protected static ?string $navigationGroup = 'content';
    protected static ?int $navigationSort = 4;



    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderBy('category');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Vraag en antwoord')
                    ->description('Voer de vraag en het bijbehorende antwoord in')
                    ->schema([
                        Forms\Components\TextInput::make('question')
                            ->label('Vraag')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('answer')
                            ->label('Antwoord')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Categorie en status')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('category')
                            ->label('Categorie')
                            ->placeholder('Bijv. Algemeen, Betaling, etc.'),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Actief')
                            ->inline(false)
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->label('Vraag')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie')
                    ->sortable()
                    ->searchable(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/nieuw'),
            'edit' => Pages\EditFaq::route('/{record}/bewerken'),
        ];
    }
}
