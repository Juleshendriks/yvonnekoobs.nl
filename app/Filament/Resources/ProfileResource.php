<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ProfileResource extends Resource
{
    protected static ?string $model = Profile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Profiel';

    protected static ?string $modelLabel = 'Profiel';

    protected static ?string $pluralModelLabel = 'Profiel';

    protected static ?string $navigationGroup = 'settings';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Profiel')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Algemeen')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\Section::make('Algemene informatie')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\FileUpload::make('photo')
                                            ->label('Profielfoto')
                                            ->image()
                                            ->imageEditor()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('naam')
                                            ->label('Naam')
                                            ->required()
                                            ->placeholder('Bijv. Jan van der Berg'),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Introductie')
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\TextInput::make('introduction_title')
                                            ->label('Introductie titel')
                                            ->required()
                                            ->placeholder('Bijv. Welkom bij mijn portfolio'),

                                        Forms\Components\Textarea::make('introduction_description')
                                            ->label('Introductie beschrijving')
                                            ->required()
                                            ->rows(3)
                                            ->placeholder('Korte beschrijving van jezelf en wat je doet'),
                                    ])
                                    ->columns(1),
                            ]),

                        Forms\Components\Tabs\Tab::make('Verhaal')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Forms\Components\Section::make('Waarom - Why')
                                    ->description('Leg uit waarom je doet wat je doet')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\TextInput::make('why_title')
                                            ->label('Waarom titel')
                                            ->placeholder('Bijv. Mijn missie'),

                                        Forms\Components\Textarea::make('why_description')
                                            ->label('Waarom beschrijving')
                                            ->rows(4)
                                            ->placeholder('Beschrijf je motivatie en waarom je dit werk doet'),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Wat - What')
                                    ->description('Beschrijf wat je doet')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\TextInput::make('what_title')
                                            ->label('Wat titel')
                                            ->placeholder('Bijv. Mijn diensten'),

                                        Forms\Components\Textarea::make('what_description')
                                            ->label('Wat beschrijving')
                                            ->rows(4)
                                            ->placeholder('Beschrijf welke diensten of producten je aanbiedt'),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Hoe - How')
                                    ->description('Leg uit hoe je te werk gaat')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\TextInput::make('how_title')
                                            ->label('Hoe titel')
                                            ->placeholder('Bijv. Mijn aanpak'),

                                        Forms\Components\Textarea::make('how_description')
                                            ->label('Hoe beschrijving')
                                            ->rows(4)
                                            ->placeholder('Beschrijf je werkwijze en aanpak'),
                                    ])
                                    ->columns(1),
                            ]),

                        Forms\Components\Tabs\Tab::make('Afsluiting & CTA')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                Forms\Components\Section::make('Afsluiting')
                                    ->description('Nodig je bezoekers uit om actie te ondernemen')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\Textarea::make('outro_message')
                                            ->label('Afsluitende boodschap')
                                            ->required()
                                            ->rows(3)
                                            ->placeholder('Een persoonlijke afsluiting van je profiel'),
                                    ])
                                    ->columns(1),

                                Forms\Components\Section::make('Call-to-Action')
                                    ->description('Zet bezoekers aan tot actie')
                                    ->collapsible()
                                    ->collapsed()
                                    ->schema([
                                        Forms\Components\FileUpload::make('cta_image')
                                            ->label('CTA afbeelding')
                                            ->image()
                                            ->imageEditor()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('cta_title')
                                            ->label('CTA titel')
                                            ->required()
                                            ->placeholder('Bijv. Neem contact op'),

                                        Forms\Components\TextInput::make('cta_description')
                                            ->label('CTA beschrijving')
                                            ->required()
                                            ->placeholder('Bijv. Klaar om samen te werken?'),

                                        Forms\Components\TextInput::make('cta_text')
                                            ->label('CTA knoptekst')
                                            ->required()
                                            ->placeholder('Bijv. Contact opnemen'),
                                    ])
                                    ->columns(1),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        // Geen table view nodig
        return $table->paginated(false);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProfile::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return false; // Geen aparte create page nodig
    }

    public static function canDelete($record): bool
    {
        return false; // Voorkom verwijdering van het profiel
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
