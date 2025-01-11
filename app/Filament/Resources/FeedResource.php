<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedResource\Pages;
use App\Filament\Resources\FeedResource\RelationManagers;
use App\Models\Feed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;

use Filament\Forms\Components\FileUpload;



class FeedResource extends Resource
{
    protected static ?string $model = Feed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rss';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Feed Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->options([
                            '0' => 'In Active',
                            '1' => 'Active',
                        ])
                        ->required()
                ]),
                Fieldset::make('Feed Description')
                    ->columns(1)
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                ]),
                Forms\Components\FileUpload::make('Image')
                ->required()
              
                

   
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SelectColumn::make('status')
                ->options([
                    '1' => 'Active',
                    '0' => 'In Active',
                ])
                ->rules(['required']) ,
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->html()
                    ->lineClamp(1)
                    ->searchable()
                    ->sortable(),

             
                Tables\Columns\ImageColumn::make('image')
               
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListFeeds::route('/'),
            'create' => Pages\CreateFeed::route('/create'),
            'edit' => Pages\EditFeed::route('/{record}/edit'),
        ];
    }
}
