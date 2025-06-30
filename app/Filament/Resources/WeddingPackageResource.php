<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeddingPackageResource\Pages;
use App\Filament\Resources\WeddingPackageResource\RelationManagers;
use App\Models\BonusPackage;
use App\Models\WeddingPackage;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeddingPackageResource extends Resource
{
    protected static ?string $model = WeddingPackage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                
                 Fieldset::make('Details')
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->required(),

            Forms\Components\Repeater::make('photos')
                ->relationship('photos')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->required(),
                ]),

            Forms\Components\Repeater::make('weddingBonusPackages')
                ->relationship('weddingBonusPackages')
                ->schema([
                    Forms\Components\Select::make('bonus_package_id')
                        ->label('Bonus Package')
                        ->options(BonusPackage::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                     ]),
                 ]),

                    Fieldset::make('Additional')
        ->schema([
                    Forms\Components\Textarea::make('about')
                        ->required(),

                    Forms\Components\TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->prefix('IDR'),

                    Forms\Components\Select::make('is_popular')
                        ->options([
                            true => 'Popular',
                            false => 'Not Popular',
                        ])
                        ->required(),

                    Forms\Components\Select::make('city_id')
                        ->relationship('city', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('wedding_organizer_id')
                        ->relationship('weddingOrganizer', 'name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
    Tables\Columns\TextColumn::make('name')
        ->searchable(),
            Tables\Columns\TextColumn::make('weddingOrganizer.name'),

            Tables\Columns\ImageColumn::make('thumbnail'),

            Tables\Columns\IconColumn::make('is_popular')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Popular'),
            ])
            ->filters([
                //
            SelectFilter::make('city_id')
                ->label('City')
                ->relationship('city', 'name'),

            SelectFilter::make('wedding_organizer_id')
                ->label('Wedding Organizer')
                ->relationship('weddingOrganizer', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),

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
            'index' => Pages\ListWeddingPackages::route('/'),
            'create' => Pages\CreateWeddingPackage::route('/create'),
            'edit' => Pages\EditWeddingPackage::route('/{record}/edit'),
        ];
    }
}
