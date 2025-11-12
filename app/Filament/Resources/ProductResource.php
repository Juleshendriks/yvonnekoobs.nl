<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoachingTypeResource\RelationManagers\FaqsRelationManager;
use App\Filament\Resources\CoachingTypeResource\RelationManagers\ReviewsRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationLabel = 'Producten';
    protected static ?string $modelLabel = 'Product';
    protected static ?string $pluralModelLabel = 'Producten';
    protected static ?string $navigationGroup = 'content';

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';
    protected static ?int $navigationSort = 2;

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basis Informatie')
                    ->description('Algemene productgegevens')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Naam')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null
                                    ),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(Product::class, 'slug', ignoreRecord: true)
                                    ->helperText('Wordt automatisch gegenereerd')
                                    ->suffixIcon('heroicon-m-globe-alt'),
                            ]),

                        Forms\Components\TextInput::make('short_description')
                            ->label('Korte beschrijving')
                            ->maxLength(255)
                            ->helperText('Voor in overzichten en preview')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Uitgebreide beschrijving')
                            ->helperText('Volledige productbeschrijving')
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'bulletList', 'orderedList',
                                'link', 'h2', 'h3'
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Prijzen & Status')
                    ->description('Prijsstelling en beschikbaarheid')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->label('Prijs')
                                    ->required()
                                    ->numeric()
                                    ->default(0)
                                    ->prefix('€')
                                    ->step(0.01)
                                    ->helperText('0.00 = gratis product'),

                                Forms\Components\TextInput::make('original_price')
                                    ->label('Oorspronkelijke prijs')
                                    ->numeric()
                                    ->prefix('€')
                                    ->step(0.01)
                                    ->helperText('Voor kortingsacties'),

                                Forms\Components\Toggle::make('is_free')
                                    ->label('Gratis product')
                                    ->helperText('Wordt automatisch ingesteld bij prijs €0')
                                    ->disabled(),
                            ]),

                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Actief')
                                    ->default(true)
                                    ->helperText('Product zichtbaar voor bezoekers'),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Uitgelicht')
                                    ->helperText('Tonen als featured product'),

                                Forms\Components\DateTimePicker::make('published_at')
                                    ->label('Publicatiedatum')
                                    ->default(now())
                                    ->helperText('Wanneer wordt het product zichtbaar'),
                            ]),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Media & Bestanden')
                    ->description('Afbeeldingen en downloadbare bestanden')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Hoofdafbeelding')
                            ->image()
                            ->directory('products/images')
                            ->imageEditor()
                            ->helperText('Aanbevolen: 800x600 pixels'),

                        Forms\Components\FileUpload::make('gallery_images')
                            ->label('Galerij afbeeldingen')
                            ->image()
                            ->multiple()
                            ->directory('products/gallery')
                            ->imageEditor()
                            ->helperText('Extra productafbeeldingen')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('file_path')
                            ->label('Downloadbaar bestand')
                            ->directory('products/downloads')
                            ->helperText('PDF, ZIP, of ander digitaal product')
                            ->acceptedFileTypes(['application/pdf', 'application/zip', 'image/*'])
                            ->maxSize(50000) // 50MB
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Forms\Components\Section::make('Categorisatie')
                    ->description('Indeling en tags')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('category')
                                    ->label('Categorie')
                                    ->helperText('Bijv: E-books, Templates, Cursussen')
                                    ->datalist([
                                        'E-books',
                                        'Templates',
                                        'Cursussen',
                                        'Werkboeken',
                                        'Checklists',
                                        'Video\'s',
                                    ]),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Sorteervolgorde')
                                    ->numeric()
                                    ->default(0)
                                    ->helperText('Lagere nummers eerst'),
                            ]),

                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->helperText('Voeg tags toe voor betere vindbaarheid')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Forms\Components\Section::make('Download Instellingen')
                    ->description('Beperkingen en toegang')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('download_limit')
                                    ->label('Download limiet')
                                    ->numeric()
                                    ->helperText('Max downloads per gebruiker (leeg = onbeperkt)'),

                                Forms\Components\TextInput::make('download_expiry_days')
                                    ->label('Verloop na dagen')
                                    ->numeric()
                                    ->helperText('Toegang verloopt na X dagen (leeg = permanent)'),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Forms\Components\Section::make('SEO & Marketing')
                    ->description('Zoekmachine optimalisatie')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('SEO Titel')
                            ->maxLength(60)
                            ->helperText('Voor Google zoekresultaten'),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('SEO Beschrijving')
                            ->maxLength(160)
                            ->rows(3)
                            ->helperText('Kort, pakkend en informatief')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(),

                Forms\Components\Section::make('Statistieken')
                    ->description('Automatisch bijgehouden cijfers')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('view_count')
                                    ->label('Bekeken')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled(),

                                Forms\Components\TextInput::make('download_count')
                                    ->label('Downloads')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled(),

                                Forms\Components\TextInput::make('purchase_count')
                                    ->label('Verkocht')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled(),
                            ]),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Afbeelding')
                    ->size(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Naam')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Prijs')
                    ->money('EUR')
                    ->sortable()
                    ->formatStateUsing(fn($state) => $state == 0 ? 'Gratis' : '€ ' . number_format($state, 2, ',', '.')),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Uitgelicht')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Actief')
                    ->boolean(),

                Tables\Columns\TextColumn::make('purchase_count')
                    ->label('Verkocht')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('download_count')
                    ->label('Downloads')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Gepubliceerd')
                    ->dateTime('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categorie')
                    ->options([
                        'E-books' => 'E-books',
                        'Templates' => 'Templates',
                        'Cursussen' => 'Cursussen',
                        'Werkboeken' => 'Werkboeken',
                        'Checklists' => 'Checklists',
                        'Video\'s' => 'Video\'s',
                    ]),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('Alle producten')
                    ->trueLabel('Alleen actieve')
                    ->falseLabel('Alleen inactieve'),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Uitgelicht')
                    ->placeholder('Alle producten')
                    ->trueLabel('Alleen uitgelichte')
                    ->falseLabel('Alleen gewone'),

                Tables\Filters\TernaryFilter::make('is_free')
                    ->label('Type')
                    ->placeholder('Alle producten')
                    ->trueLabel('Alleen gratis')
                    ->falseLabel('Alleen betaald'),
            ])
            ->actions([
                Tables\Actions\Action::make('preview')
                    ->label('Bekijk Live')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Product $record): string => route('web.products.show', $record->slug))
                    ->openUrlInNewTab()
                    ->color('info'),

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
            ->emptyStateHeading('Nog geen producten')
            ->emptyStateDescription('Maak je eerste product aan om te beginnen met verkopen.')
            ->emptyStateIcon('heroicon-o-shopping-bag');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/nieuw'),
            'edit' => Pages\EditProduct::route('/{record}/bewerken'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'short_description', 'tags'];
    }
}
