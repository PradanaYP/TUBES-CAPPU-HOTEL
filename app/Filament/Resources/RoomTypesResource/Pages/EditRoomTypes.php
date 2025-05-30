<?php

namespace App\Filament\Resources\RoomTypesResource\Pages;

use App\Filament\Resources\RoomTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoomTypes extends EditRecord
{
    protected static string $resource = RoomTypesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
