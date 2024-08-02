<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentTypeResource\Pages;
use App\Filament\Resources\ContentTypeResource\RelationManagers;
use App\Models\ContentType;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class ContentTypeResource extends Resource
{
    protected static ?string $model = ContentType::class;
    protected static ?string $navigationGroup = 'Users Settings';

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(64),
                TextInput::make('slug')
                    ->disabled()
                    ->visible(false)
                    ->maxLength(71)
                    ->unique(ignoreRecord: true),
                ColorPicker::make('background_color')
                    ->required(),
                ColorPicker::make('text_color')
                    ->required(),
                TextInput::make('meta_title')
                    ->required()
                    ->maxLength(128)
                    ->unique(ignoreRecord: true),
                Textarea::make('meta_description')
                    ->required()
                    ->maxLength(278),
                ]),
                Group::make()->schema([
                    FileUpload::make('icon')
                        ->nullable()
                        ->disk('public')
                        ->directory('icons')
                        ->image(),
                    FileUpload::make('image')
                        ->nullable()
                        ->disk('public')
                        ->directory('images')
                        ->image(),
                    TextInput::make('image_alt')
                        ->nullable()
                        ->maxLength(256),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ColorColumn::make('background_color'),
                ColorColumn::make('text_color'),
                ImageColumn::make('icon'),
                ImageColumn::make('image'),
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
            'index' => Pages\ListContentTypes::route('/'),
            'create' => Pages\CreateContentType::route('/create'),
            'edit' => Pages\EditContentType::route('/{record}/edit'),
        ];
    }
}
