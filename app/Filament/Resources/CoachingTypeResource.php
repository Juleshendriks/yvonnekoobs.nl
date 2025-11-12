<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoachingTypeResource\Pages;
use App\Filament\Resources\CoachingTypeResource\RelationManagers\FaqsRelationManager;
use App\Filament\Resources\CoachingTypeResource\RelationManagers\ReviewsRelationManager;
use App\Models\CoachingType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CoachingTypeResource extends Resource
{
    protected static ?string $model = CoachingType::class;

    protected static ?string $navigationLabel = 'Coachingsoorten';
    protected static ?string $modelLabel = 'Coachingsoort';
    protected static ?string $pluralModelLabel = 'Coachingsoorten';
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Algemene Informatie')
                    ->description('Basis gegevens van de coachingsoort')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Titel')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                    $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(CoachingType::class, 'slug', ignoreRecord: true)
                                    ->helperText('Wordt automatisch gegenereerd vanaf de titel'),
                            ]),

                        Forms\Components\TextInput::make('subtitle')
                            ->label('Subtitel')
                            ->maxLength(255)
                            ->helperText('Korte beschrijving die onder de titel wordt getoond')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('summary')
                            ->label('Samenvatting')
                            ->helperText('Korte introductie voor op de overzichtspagina')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('banner_image')
                                    ->label('Banner afbeelding')
                                    ->image()
                                    ->directory('coaching_banners')
                                    ->imageEditor()
                                    ->helperText('Aanbevolen formaat: 1200x600 pixels'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Sorteervolgorde')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lagere nummers worden eerst getoond'),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Uitgebreide Content')
                    ->description('Gedetailleerde beschrijving van de coachingsoort')
                    ->schema([
                        Forms\Components\RichEditor::make('challenges')
                            ->label('Uitdagingen & Problemen')
                            ->helperText('Welke problemen lost deze coaching op?')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'h2',
                                'h3',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('approach')
                            ->label('Aanpak & Werkwijze')
                            ->helperText('Hoe werkt deze vorm van coaching?')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'h2',
                                'h3',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('target_audience')
                            ->label('Doelgroep')
                            ->helperText('Voor wie is deze coaching bedoeld?')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'h2',
                                'h3',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('benefits')
                            ->label('Resultaten & Voordelen')
                            ->helperText('Wat kan de klant verwachten?')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                                'h2',
                                'h3',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('call_to_action')
                            ->label('Call to Action')
                            ->helperText('Oproep tot actie aan het einde van de pagina')
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Banner')
                    ->size(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitel')
                    ->searchable()
                    ->limit(40)
                    ->color('gray'),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->fontFamily('mono')
                    ->size('sm'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Volgorde')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Bijgewerkt')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Live Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn (CoachingType $record): string => route('web.coaching-types.show', $record->slug))
                    ->openUrlInNewTab()
                    ->color('info'),
                Tables\Actions\ViewAction::make()
                    ->label('Bekijken'),
                Tables\Actions\EditAction::make()
                    ->label('Bewerken'),
                Tables\Actions\DeleteAction::make()
                    ->label('Verwijderen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Geselecteerde verwijderen'),
                ]),
            ])
            ->emptyStateHeading('Nog geen coachingsoorten')
            ->emptyStateDescription('Maak je eerste coachingsoort aan om te beginnen.')
            ->emptyStateIcon('heroicon-o-academic-cap');
    }

    public static function getRelations(): array
    {
        return [
            ReviewsRelationManager::class,
            FaqsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCoachingTypes::route('/'),
            'create' => Pages\CreateCoachingType::route('/nieuw'),
            'edit' => Pages\EditCoachingType::route('/{record}/bewerken'),
        ];
    }
}
