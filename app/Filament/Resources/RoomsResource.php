<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomsResource\Pages;
use App\Filament\Resources\RoomsResource\RelationManagers;
use App\Models\Rooms;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomsResource extends Resource
{
    protected static ?string $model = Rooms::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('roomtype_id') // Fixed: sesuai dengan foreign key di model
                        ->label('Room Type')
                        ->relationship('roomTypes', 'type_name') // Fixed: sesuai dengan method di model
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('type_name')
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->required(),
                            Forms\Components\TextInput::make('price_per_night')
                                ->required()
                                ->numeric()
                                ->prefix('Rp'),
                        ]),
                    
                    Forms\Components\TextInput::make('room_number')
                        ->label('Room Number')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255)
                        ->placeholder('e.g., 101, 102A'),
                    
                    Forms\Components\Select::make('status')
                        ->label('Room Status')
                        ->required()
                        ->options([
                            'available' => 'Available',
                            'booked' => 'Booked',
                            'maintenance' => 'Maintenance',
                        ])
                        ->default('available')
                        ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('room_number')
                ->label('Room Number')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('roomTypes.type_name') // Fixed: sesuai dengan method di model
                ->label('Room Type')
                ->searchable()
                ->sortable(),
            
            Tables\Columns\TextColumn::make('roomTypes.price_per_night') // Fixed: sesuai dengan method di model
                ->label('Price per Night')
                ->money('IDR')
                ->sortable(),
            
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'available',
                    'warning' => 'booked',
                    'danger' => 'maintenance',
                ])
                ->icons([
                    'heroicon-o-check-circle' => 'available',
                    'heroicon-o-clock' => 'booked',
                    'heroicon-o-wrench-screwdriver' => 'maintenance',
                ]),
            
            Tables\Columns\TextColumn::make('reservations_count')
                ->label('Total Reservations')
                ->counts('reservations')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                 Tables\Filters\SelectFilter::make('roomtype_id') // Fixed: sesuai dengan foreign key di model
                ->label('Room Type')
                ->relationship('roomTypes', 'type_name') // Fixed: sesuai dengan method di model
                ->searchable()
                ->preload(),
            
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'available' => 'Available',
                    'booked' => 'Booked',
                    'maintenance' => 'Maintenance',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRooms::route('/create'),
            'edit' => Pages\EditRooms::route('/{record}/edit'),
        ];
    }
}
