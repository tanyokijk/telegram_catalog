<?php

namespace App\Filament\Resources;

use App\Enums\AccessType;
use App\Enums\ChatType;
use App\Enums\UserRoleEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;


    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                Select::make('role')
                    ->required()
                    ->options(array_combine(UserRoleEnum::values(), UserRoleEnum::values()))
                    ->disabled(function () {
                        $currentUser = Auth::user();
                        return $currentUser && $currentUser['role'] === UserRoleEnum::MODERATOR;
                    }),

                TextInput::make('email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->required()
                    ->password()
                    ->visibleOn('create'),
                TextInput::make('telegram_id')
                    ->numeric()
                    ->unique()
                    ->nullable(),
                TextInput::make('username')
                    ->unique()
                    ->maxLength(32)
                    ->nullable(),
                TextInput::make('avatar_url')
                    ->url()
                    ->maxLength(2048)
                    ->nullable(),
                TextInput::make('first_name')
                    ->maxLength(64)
                    ->nullable(),
                TextInput::make('last_name')
                    ->maxLength(64)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('telegram_id')->searchable(),
                TextColumn::make('username')->sortable()->searchable(),
                TextColumn::make('first_name')->sortable()->searchable(),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(function (UserRoleEnum $state) : string {
                        return match ($state) {
                            UserRoleEnum::ADMIN => 'danger',
                            UserRoleEnum::MODERATOR => 'info',
                            UserRoleEnum::USER => 'success',

                        };
                    }),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Role')
                    ->options(array_combine(UserRoleEnum::values(), UserRoleEnum::values()))
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
