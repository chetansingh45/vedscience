<?php

namespace App\Filament\Resources\FeedCategoriesResource\Pages;

use App\Filament\Resources\FeedCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedCategories extends ListRecords
{
    protected static string $resource = FeedCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
