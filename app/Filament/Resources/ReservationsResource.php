<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationsResource\Pages;
use App\Filament\Resources\ReservationsResource\RelationManagers;
use App\Models\Reservations;
use App\Models\Payments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReservationsResource extends Resource
{
    protected static ?string $model = Reservations::class;

    public static function afterSave($record): void
    {
        if (in_array($record->status, ['checked_out', 'cancelled'])) {
            $record->rooms()->update(['status' => 'available']);
        }
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('guest_id')
                        ->label('Guest')
                        ->relationship('guest', 'name') // Assuming User model has 'name' field
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->required(),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required(),
                            Forms\Components\TextInput::make('phone')
                                ->tel(),
                        ]),
                    
                    Forms\Components\Select::make('room_id') // Assuming foreign key is room_id
                        ->label('Room')
                        ->relationship('rooms', 'room_number')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->getOptionLabelFromRecordUsing(function ($record) {
                            return $record->room_number . ' - ' . $record->roomTypes->type_name;
                        }),
                    
                    Forms\Components\DatePicker::make('check_in')
                        ->label('Check-in Date')
                        ->required()
                        ->native(false)
                        ->minDate(now())
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            if ($state) {
                                $set('check_out_date', null);
                            }
                        }),
                    
                    Forms\Components\DatePicker::make('check_out')
                        ->label('Check-out Date')
                        ->required()
                        ->native(false)
                        ->minDate(function (callable $get) {
                            $checkIn = $get('check_in_date');
                            return $checkIn ? date('Y-m-d', strtotime($checkIn . ' +1 day')) : now()->addDay();
                        })
                        ->reactive(),
                    
                    Forms\Components\TextInput::make('guests')
                        ->label('Total Guests')
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10)
                        ->default(1),
                    
                    Forms\Components\Select::make('status')
                        ->label('Reservation Status')
                        ->required()
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'checked_in' => 'Checked In',
                            'checked_out' => 'Checked Out',
                            'cancelled' => 'Cancelled',
                        ])
                        ->default('pending')
                        ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('res_id')
                ->label('Reservation ID')
                ->sortable()
                ->prefix('#'),
            
            Tables\Columns\TextColumn::make('guest.name')
                ->label('Guest Name')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('guest.email')
                ->label('Guest Email')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
            
            Tables\Columns\TextColumn::make('rooms.room_number')
                ->label('Room')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('rooms.roomTypes.type_name')
                ->label('Room Type')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('check_in')
                ->label('Check-in')
                ->date()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('check_out')
                ->label('Check-out')
                ->date()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('guests')
                ->label('Guests')
                ->sortable()
                ->badge()
                ->color('gray'),
            
            Tables\Columns\TextColumn::make('payments.amount')
                ->label('Amount')
                ->money('IDR', true)
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('payments.payment_method')
                ->label('Payment Method')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'warning' => 'pending',
                    'success' => 'confirmed',
                    'primary' => 'checked_in',
                    'secondary' => 'checked_out',
                    'danger' => 'cancelled',
                ])
                ->icons([
                    'heroicon-o-clock' => 'pending',
                    'heroicon-o-check-circle' => 'confirmed',
                    'heroicon-o-home' => 'checked_in',
                    'heroicon-o-arrow-right-on-rectangle' => 'checked_out',
                    'heroicon-o-x-circle' => 'cancelled',
                ]),
            
            Tables\Columns\TextColumn::make('created_at')
                ->label('Booked')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                 Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'checked_in' => 'Checked In',
                    'checked_out' => 'Checked Out',
                    'cancelled' => 'Cancelled',
                ]),
            
            Tables\Filters\SelectFilter::make('room_id')
                ->label('Room')
                ->relationship('rooms', 'room_number')
                ->searchable()
                ->preload(),
            
            Tables\Filters\Filter::make('check_in_date')
                ->form([
                    Forms\Components\DatePicker::make('check_in_from')
                        ->label('Check-in From'),
                    Forms\Components\DatePicker::make('check_in_until')
                        ->label('Check-in Until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['check_in_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('check_in_date', '>=', $date),
                        )
                        ->when(
                            $data['check_in_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('check_in_date', '<=', $date),
                        );
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservations::route('/create'),
            'edit' => Pages\EditReservations::route('/{record}/edit'),
        ];
    }
}
