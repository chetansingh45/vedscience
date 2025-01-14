<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedResource\Pages;
use App\Models\Feed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Section;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;


class FeedResource extends Resource
{
    protected static ?string $model = Feed::class;
    protected static ?string $navigationIcon = 'heroicon-o-rss';
protected static ?string $recordTitleAttribute = 'title';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Feed Details')
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('feed_cat_id')
                            ->relationship('feedCategory', 'name')
                            ->required(),

                            TextInput::make('title')
                            ->label('Title')
                            ->live(onBlur: true) 
                            ->reactive()         
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            })
                            ->required()
                            ->maxLength(255),
            
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Feed::class, 'slug') 
                            ->placeholder('Auto-generated from title')
                            ->helperText('You can modify this manually if needed.'),

                        TagsInput::make('tags')
                            ->required(),

                        Forms\Components\Select::make('status')
                            ->options([
                                '0' => 'Inactive',
                                '1' => 'Active',
                            ])
                            ->required(),
                    ]),
                Fieldset::make('Feed Description')
                    ->columns(1)
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                    Section::make()->columns(2)
                    ->schema([
                        Forms\Components\FileUpload::make('main_image')
                    ->required()
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->directory('feeds'),
                Forms\Components\FileUpload::make('thumbnail_image')
                    ->required()
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->directory('thumbnail'),

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('feedCategory.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
                    ->rules(['required']),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->html()
                    ->lineClamp(1)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TagsColumn::make('tags')->separator(','),
                Tables\Columns\ImageColumn::make('main_image'),
                Tables\Columns\ImageColumn::make('thumbnail_image'),
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
