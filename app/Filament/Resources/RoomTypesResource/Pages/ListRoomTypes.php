<?php

namespace App\Filament\Resources\RoomTypesResource\Pages;

use App\Filament\Resources\RoomTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRoomTypes extends ListRecords
{
    protected static string $resource = RoomTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
