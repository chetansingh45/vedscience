<?php

namespace App\Filament\Resources\FeedCategoriesResource\Pages;

use App\Filament\Resources\FeedCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeedCategories extends EditRecord
{
    protected static string $resource = FeedCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
