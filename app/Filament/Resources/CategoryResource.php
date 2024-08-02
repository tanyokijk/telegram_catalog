<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationGroup = 'Admins Settings';
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(32),
                    TextInput::make('slug')
                        ->disabled()
                        ->visible(false)
                        ->maxLength(71)
                        ->unique(ignoreRecord: true),
                    TagsInput::make('aliases')->required(),
                    TextInput::make('meta_title')
                        ->required()
                        ->maxLength(128)
                        ->unique(ignoreRecord: true),
                    Textarea::make('meta_description')
                        ->required()
                        ->maxLength(278),
                    Select::make('parent_id')
                        ->nullable()
                        ->relationship('parent', 'name'),
                ])->columnSpan(1),
                Group::make()
                    ->schema([
                FileUpload::make('image')
                    ->nullable()
                    ->disk('public')
                    ->directory('images')
                    ->maxSize(1024)
                    ->image(),
                TextInput::make('image_alt')
                    ->nullable()
                    ->maxLength(256),
                FileUpload::make('icon')
                    ->nullable()
                    ->disk('public')
                    ->directory('icons')
                    ->maxSize(1024)
                    ->image(),
                FileUpload::make('avatar')
                    ->nullable()
                    ->disk('public')
                    ->directory('avatars')
                    ->maxSize(1024)
                    ->image(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('aliases')->sortable()->searchable(),
                ImageColumn::make('icon'),
                ImageColumn::make('avatar'),
                ImageColumn::make('image'),
                TextColumn::make('parent.name')
                    ->label('Parent Category')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
