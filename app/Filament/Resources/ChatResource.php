<?php

namespace App\Filament\Resources;

use App\Enums\AccessType;
use App\Enums\ChatType;
use App\Filament\Resources\ChatResource\Pages;
use App\Filament\Resources\ChatResource\RelationManagers;
use App\Models\Chat;
use App\Models\Language;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChatResource extends Resource
{
    protected static ?string $model = Chat::class;
    protected static ?string $navigationGroup = 'Users Settings';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    TextInput::make('chat_id')
                        ->required()
                        ->numeric()
                        ->unique(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Textarea::make('description')
                        ->nullable(),
                    TextInput::make('username')
                        ->required()
                        ->label('Chat`s username')
                        ->maxLength(32)
                        ->unique(ignoreRecord: true),
                    Grid::make()
                        ->schema([
                    Select::make('type')
                        ->options(array_combine(ChatType::values(), ChatType::values()))
                        ->required(),
                            Select::make('access_type')
                                ->required()
                                ->options(array_combine(AccessType::values(), AccessType::values())),
                        ])
                        ->columns(2),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('language_id')
                    ->label('Language')
                    ->relationship('language', 'name')
                    ->required(),
                ]),
                Group::make()->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('avg_views')
                                ->nullable()
                                ->numeric(),
                            TextInput::make('subscribers')
                                ->nullable()
                                ->numeric(),
                        ])
                        ->columns(2),

                    Checkbox::make('is_published')
                        ->default(false)
                    ->visible(false),
                    TextInput::make('invite_link')
                        ->nullable()
                        ->url()
                        ->maxLength(2048),
                    TextInput::make('meta_title')
                        ->required()
                        ->maxLength(128)
                        ->unique(ignoreRecord: true),
                    Textarea::make('meta_description')
                        ->required()
                        ->maxLength(278),
                    FileUpload::make('avatar')
                        ->nullable()
                        ->disk('public')
                        ->directory('avatars')
                        ->image(),
                    Grid::make()->schema([
                        FileUpload::make('image')
                            ->nullable()
                            ->disk('public')
                            ->directory('images')
                            ->image(),
                        TextInput::make('image_alt')
                            ->nullable()
                            ->maxLength(256),
                    ])->columns(2),

                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('chat_id')->sortable()->searchable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('username')->sortable()->searchable(),
                CheckboxColumn::make('is_published'),
                TextColumn::make('type'),
                TextColumn::make('access_type'),
                TextColumn::make('user.name')->label('User'),
                TextColumn::make('language.name')->label('Language'),
                TextColumn::make('avg_views')->sortable(),
                TextColumn::make('subscribers')->sortable(),

            ])
            ->filters([
                Filter::make('Published')->query(
                    function ($query){
                        return $query->where('is_published', true);
                    }
                ),
                SelectFilter::make('language_id')
                ->label('Language')
                ->options(Language::all()->pluck('name','id'))
                ->multiple(),

                SelectFilter::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name','id'))
                    ->multiple(),

                SelectFilter::make('type')
                    ->label('Type')
                    ->options(array_combine(ChatType::values(), ChatType::values()))
                    ->multiple(),
                SelectFilter::make('access_type')
                    ->label('Access Type')
                    ->options(array_combine(AccessType::values(), AccessType::values()))
                    ->multiple(),
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
            'index' => Pages\ListChats::route('/'),
            'create' => Pages\CreateChat::route('/create'),
            'edit' => Pages\EditChat::route('/{record}/edit'),
        ];
    }
}
