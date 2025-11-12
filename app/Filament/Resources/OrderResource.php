<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\PaymentsRelationManager;
use App\Filament\Resources\OrderResource\RelationManagers\OrderItemsRelationManager;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationLabel = 'Bestellingen';
    protected static ?string $modelLabel = 'Bestelling';
    protected static ?string $pluralModelLabel = 'Bestellingen';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'customers';
    protected static ?int $navigationSort = 1;

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Bestelling Informatie')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('order_number')
                                    ->label('Bestelnummer')
                                    ->required()
                                    ->maxLength(255)
                                    ->default(fn() => Order::generateOrderNumber())
                                    ->disabled(fn(?Order $record) => $record !== null),

                                Forms\Components\Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'pending' => 'Wachtend',
                                        'paid' => 'Betaald',
                                        'failed' => 'Mislukt',
                                        'cancelled' => 'Geannuleerd',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),

                        Forms\Components\Select::make('user_id')
                            ->label('Klant')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->label('Naam')
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->required(),
                                Forms\Components\TextInput::make('password')
                                    ->label('Wachtwoord')
                                    ->password()
                                    ->required(),
                            ]),
                    ]),

                Forms\Components\Section::make('Klant Gegevens')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('customer_name')
                                    ->label('Klant Naam')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('customer_email')
                                    ->label('Klant Email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),
                            ]),
                    ]),

                Forms\Components\Section::make('Bedragen')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('subtotal')
                                    ->label('Subtotaal')
                                    ->numeric()
                                    ->prefix('€')
                                    ->step(0.01)
                                    ->disabled(),

                                Forms\Components\TextInput::make('total')
                                    ->label('Totaal')
                                    ->numeric()
                                    ->prefix('€')
                                    ->step(0.01)
                                    ->disabled(),

                                Forms\Components\TextInput::make('currency')
                                    ->label('Valuta')
                                    ->default('EUR')
                                    ->disabled(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->label('Bestelnummer')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Klant')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'paid',
                        'danger' => ['failed', 'cancelled'],
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Wachtend',
                        'paid' => 'Betaald',
                        'failed' => 'Mislukt',
                        'cancelled' => 'Geannuleerd',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('total')
                    ->label('Totaal')
                    ->money('EUR')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('latest_payment.method')
                    ->label('Betaalmethode')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'ideal' => 'iDEAL',
                        'creditcard' => 'Creditcard',
                        'bancontact' => 'Bancontact',
                        null => '-',
                        default => ucfirst($state),
                    })
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aangemaakt')
                    ->dateTime('d-m-Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Wachtend',
                        'paid' => 'Betaald',
                        'failed' => 'Mislukt',
                        'cancelled' => 'Geannuleerd',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->label('Datum')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Van'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Tot'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn($query, $date) => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn($query, $date) => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Bekijken'),
                Tables\Actions\EditAction::make()
                    ->label('Bewerken'),

                Tables\Actions\Action::make('mark_paid')
                    ->label('Markeer als Betaald')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Order $record) {
                        $record->markAsPaid();
                    })
                    ->visible(fn (Order $record): bool => $record->status !== 'paid'),

                Tables\Actions\Action::make('resend_payment_link')
                    ->label('Herstu​​ur Betaallink')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(function (Order $record) {
                        // TODO: Implement resend payment logic
                        \Filament\Notifications\Notification::make()
                            ->title('Betaallink verstuurd')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Order $record): bool => $record->status === 'pending'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Verwijder geselecteerde'),
                ]),
            ])
            ->emptyStateHeading('Nog geen bestellingen')
            ->emptyStateDescription('Bestellingen verschijnen hier zodra klanten producten kopen.')
            ->emptyStateIcon('heroicon-o-shopping-cart');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Bestelling Details')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('order_number')
                                    ->label('Bestelnummer')
                                    ->copyable(),

                                Infolists\Components\TextEntry::make('status')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'paid' => 'success',
                                        'failed' => 'danger',
                                        'cancelled' => 'gray',
                                        default => 'gray',
                                    }),

                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Aangemaakt')
                                    ->dateTime('d-m-Y H:i:s'),

                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Laatst bijgewerkt')
                                    ->dateTime('d-m-Y H:i:s'),
                            ]),
                    ]),

                Infolists\Components\Section::make('Klant Informatie')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('customer_name')
                                    ->label('Naam'),

                                Infolists\Components\TextEntry::make('customer_email')
                                    ->label('Email')
                                    ->copyable(),

                                Infolists\Components\TextEntry::make('user.name')
                                    ->label('Gebruiker Account')
                                    ->url(fn (?Order $record): ?string =>
                                    $record?->user ? route('filament.admin.resources.users.view', $record->user) : null
                                    ),
                            ]),
                    ]),

                Infolists\Components\Section::make('Financiële Details')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('subtotal')
                                    ->label('Subtotaal')
                                    ->money('EUR'),

                                Infolists\Components\TextEntry::make('total')
                                    ->label('Totaal')
                                    ->money('EUR')
                                    ->weight('bold'),

                                Infolists\Components\TextEntry::make('currency')
                                    ->label('Valuta'),
                            ]),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemsRelationManager::class,
            PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/nieuw'),
//            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/bewerken'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count() ?: null;
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['order_number', 'customer_name', 'customer_email'];
    }
}
