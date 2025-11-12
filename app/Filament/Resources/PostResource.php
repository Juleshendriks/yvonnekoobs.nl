<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Blog Posts';

    protected static ?string $modelLabel = 'Blog Post';

    protected static ?string $pluralModelLabel = 'Blog Posts';

    protected static ?string $navigationGroup = 'content';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basis Informatie')
                    ->description('Vul de basis gegevens van je blog post in')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Titel')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                            $operation === 'create' ? $set('slug', Str::slug($state)) : null
                            )
                            ->placeholder('Bijvoorbeeld: 10 Tips voor Persoonlijke Groei'),

                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->placeholder('bijvoorbeeld-10-tips-voor-persoonlijke-groei')
                            ->helperText('Dit wordt gebruikt in de URL van je post'),

                        Forms\Components\Textarea::make('excerpt')
                            ->label('Korte Samenvatting')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('Een korte introductie of samenvatting van je post...')
                            ->helperText('Deze tekst verschijnt in overzichten en previews'),

                        Forms\Components\Select::make('category')
                            ->label('Categorie')
                            ->options([
                                'Persoonlijke Ontwikkeling' => 'Persoonlijke Ontwikkeling',
                                'Coaching' => 'Coaching',
                                'Mindfulness' => 'Mindfulness',
                                'Productiviteit' => 'Productiviteit',
                                'Welzijn' => 'Welzijn',
                                'Carrière' => 'Carrière',
                                'Relaties' => 'Relaties',
                            ])
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nieuwe categorie')
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data, Forms\Components\Select $component): string {
                                // Just return the new category name to add to the dropdown
                                $component->options([
                                    ...$component->getOptions(),
                                    $data['name'] => $data['name'],
                                ]);

                                return $data['name'];
                            })
                            ->placeholder('Selecteer of maak een categorie aan')
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Inhoud')
                    ->description('Schrijf de volledige inhoud van je blog post')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Post Inhoud')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'heading',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'codeBlock',
                                'undo',
                                'redo',
                            ])
                            ->placeholder('Begin met schrijven...'),
                    ]),

                Forms\Components\Section::make('Afbeelding & Tags')
                    ->description('Upload een afbeelding en voeg tags toe')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Uitgelichte Afbeelding')
                            ->image()
                            ->directory('posts')
                            ->maxSize(5120)
                            ->imageEditor()
                            ->helperText('Aanbevolen: 1200x630 pixels voor beste resultaat'),

                        Forms\Components\TagsInput::make('tags')
                            ->label('Tags')
                            ->placeholder('Voeg een tag toe en druk op Enter')
                            ->helperText('Voeg relevante zoekwoorden toe voor betere vindbaarheid')
                            ->suggestions([
                                'persoonlijke groei',
                                'mindfulness',
                                'productiviteit',
                                'coaching',
                                'motivatie',
                                'doelen',
                                'balans',
                                'stress',
                            ]),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Publicatie Instellingen')
                    ->description('Bepaal wanneer en hoe je post wordt gepubliceerd')
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Gepubliceerd')
                            ->helperText('Schakel in om de post zichtbaar te maken voor bezoekers')
                            ->live()
                            ->default(false),

                        Forms\Components\Toggle::make('is_newsletter_post')
                            ->label('Nieuwsbrief Post')
                            ->helperText('Schakel in om abbonees op de hoogte te stellen.')
                            ->live()
                            ->default(false),


//                        Forms\Components\DateTimePicker::make('published_at')
//                            ->label('Publicatie Datum')
//                            ->native(false)
//                            ->displayFormat('d-m-Y H:i')
//                            ->seconds(false)
//                            ->default(now())
//                            ->helperText('Kies wanneer deze post gepubliceerd moet worden')
//                            ->visible(fn (Forms\Get $get) => $get('is_published')),

                        Forms\Components\Toggle::make('is_featured')
                            ->label('Uitgelicht')
                            ->helperText('Toon deze post prominent op de homepage')
                            ->default(false),

                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('SEO Instellingen')
                    ->description('Optimaliseer je post voor zoekmachines')
                    ->collapsed()
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('SEO Titel')
                            ->maxLength(60)
                            ->placeholder('Optioneel: aangepaste titel voor Google')
                            ->helperText('Laat leeg om de post titel te gebruiken (max 60 tekens)'),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('SEO Beschrijving')
                            ->rows(3)
                            ->maxLength(160)
                            ->placeholder('Optioneel: korte beschrijving voor in zoekresultaten')
                            ->helperText('Aanbevolen: 150-160 tekens voor optimale weergave in Google'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Afbeelding')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder-post.jpg')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->weight('semibold'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Uitgelicht')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('view_count')
                    ->label('Weergaven')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Gepubliceerd op')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Auteur')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

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
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Categorie')
                    ->options([
                        'Persoonlijke Ontwikkeling' => 'Persoonlijke Ontwikkeling',
                        'Coaching' => 'Coaching',
                        'Mindfulness' => 'Mindfulness',
                        'Productiviteit' => 'Productiviteit',
                        'Welzijn' => 'Welzijn',
                        'Carrière' => 'Carrière',
                        'Relaties' => 'Relaties',
                    ]),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Publicatiestatus')
                    ->placeholder('Alle posts')
                    ->trueLabel('Alleen gepubliceerd')
                    ->falseLabel('Alleen concepten')
                    ->native(false),

                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Uitgelicht')
                    ->placeholder('Alle posts')
                    ->trueLabel('Alleen uitgelicht')
                    ->falseLabel('Niet uitgelicht')
                    ->native(false),

                Tables\Filters\Filter::make('published_at')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->label('Gepubliceerd vanaf')
                            ->native(false),
                        Forms\Components\DatePicker::make('published_until')
                            ->label('Gepubliceerd tot')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    }),

            ])
            ->actions([
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
                        ->label('Verwijderen'),
                ]),
            ])
            ->emptyStateHeading('Nog geen blog posts')
            ->emptyStateDescription('Maak je eerste blog post aan om te beginnen.')
            ->emptyStateIcon('heroicon-o-document-text');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }



    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_published', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'success';
    }
}
