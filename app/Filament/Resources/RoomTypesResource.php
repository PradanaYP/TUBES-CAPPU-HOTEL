<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomTypesResource\Pages;
use App\Filament\Resources\RoomTypesResource\RelationManagers;
use App\Models\Room_Types; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomTypesResource extends Resource
{
    protected static ?string $model = Room_Types::class; 

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Room Type Information')
                ->schema([
                    Forms\Components\TextInput::make('type_name')
                        ->label('Type Name')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('e.g., Standard, Deluxe, Suite'),
                    
                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->required()
                        ->rows(4)
                        ->placeholder('Describe the room type features and amenities'),
                    
                    Forms\Components\TextInput::make('price_per_night')
                        ->label('Price per Night')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->minValue(0)
                        ->step(1000)
                        ->placeholder('e.g., 500000'),
                ])
                ->columns(1),
                
                Forms\Components\Section::make('Images')
                ->schema([
                    Forms\Components\FileUpload::make('overview_image')
                        ->label('Overview Image')
                        ->image()
                        ->required()
                        ->maxSize(512) 
                        ->directory('room-types/overview')
                        ->visibility('public')
                        ->imagePreviewHeight('120')
                        ->panelLayout('compact')
                        ->helperText('Max size: 512KB'),

                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\FileUpload::make('gallery_image_1')
                                ->label('Gallery 1')
                                ->image()
                                ->maxSize(512)
                                ->directory('room-types/gallery')
                                ->visibility('public')
                                ->imagePreviewHeight('80')
                                ->panelLayout('compact'),

                            Forms\Components\FileUpload::make('gallery_image_2')
                                ->label('Gallery 2')
                                ->image()
                                ->maxSize(512)
                                ->directory('room-types/gallery')
                                ->visibility('public')
                                ->imagePreviewHeight('80')
                                ->panelLayout('compact'),

                            Forms\Components\FileUpload::make('gallery_image_3')
                                ->label('Gallery 3')
                                ->image()
                                ->maxSize(512)
                                ->directory('room-types/gallery')
                                ->visibility('public')
                                ->imagePreviewHeight('80')
                                ->panelLayout('compact'),
                        ])
                ])
                ->collapsible()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type_name')
                ->label('Type Name')
                ->searchable()
                ->sortable()
                ->weight('bold'),
            
            Tables\Columns\TextColumn::make('description')
                ->label('Description')
                ->searchable()
                ->limit(50)
                ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                    $state = $column->getState();
                    if (strlen($state) <= 50) {
                        return null;
                    }
                    return $state;
                }),
            
            Tables\Columns\TextColumn::make('price_per_night')
                ->label('Price per Night')
                ->money('IDR')
                ->sortable(),
            
            Tables\Columns\TextColumn::make('rooms_count')
                ->label('Total Rooms')
                ->counts('rooms')
                ->sortable()
                ->badge()
                ->color('primary'),
            
            Tables\Columns\TextColumn::make('created_at')
                ->label('Created')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Updated')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('price_range')
                ->form([
                    Forms\Components\TextInput::make('price_from')
                        ->label('Price From')
                        ->numeric()
                        ->prefix('Rp'),
                    Forms\Components\TextInput::make('price_to')
                        ->label('Price To')
                        ->numeric()
                        ->prefix('Rp'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['price_from'],
                            fn (Builder $query, $price): Builder => $query->where('price_per_night', '>=', $price),
                        )
                        ->when(
                            $data['price_to'],
                            fn (Builder $query, $price): Builder => $query->where('price_per_night', '<=', $price),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                 Action::make('view_images')
                    ->label('View Images')
                    ->icon('heroicon-o-photo')
                    ->modalHeading('Room Images')
                    ->modalSubmitAction(false)
                    ->modalContent(function ($record) {
                        $overviewImageUrl = $record->overview_image ? \Storage::url($record->overview_image) : null;
                        
                        // Gallery images dari database individual fields
                        $galleryImages = [
                            $record->gallery_image_1,
                            $record->gallery_image_2,
                            $record->gallery_image_3
                        ];

                        $galleryHtml = '';
                        $hasGalleryImages = false;
                        
                        foreach ($galleryImages as $image) {
                            if ($image) {
                                $galleryHtml .= '<img src="' . \Storage::url($image) . '" class="rounded w-full mb-2 shadow max-w-sm" style="max-height: 200px; object-fit: cover;" loading="lazy" />';
                                $hasGalleryImages = true;
                            }
                        }
                        
                        if (!$hasGalleryImages) {
                            $galleryHtml = '<p class="text-sm text-gray-500">No gallery images uploaded.</p>';
                        }

                        return new \Illuminate\Support\HtmlString('
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-semibold mb-1">Overview Image</h3>'
                                    . ($overviewImageUrl
                                        ? '<img src="' . $overviewImageUrl . '" class="rounded w-full shadow max-w-md mx-auto" style="max-height: 300px; object-fit: cover;" loading="lazy" />'
                                        : '<p class="text-sm text-gray-500">No overview image available.</p>') .
                                '</div>
                                <div>
                                    <h3 class="text-sm font-semibold mb-1">Gallery Images</h3>'
                                    . $galleryHtml .
                                '</div>
                            </div>
                        ');
                    }),
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
            'index' => Pages\ListRoomTypes::route('/'),
            'create' => Pages\CreateRoomTypes::route('/create'),
            'edit' => Pages\EditRoomTypes::route('/{record}/edit'),
        ];
    }
}