<?php

namespace App\Filament\Resources;
use App\Filament\Resources\MobiliteResource\Pages;
use App\Models\Mobilite;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class MobiliteResource extends Resource
{
    protected static ?string $model = Mobilite::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->label('Status de la demande')
                    ->options([
                        'en attente' => 'En attente',
                        'validé' => 'Validé',
                        'refusé' => 'Refusé',
                    ])
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $state === 'refusé' ? $set('motif_refus', '') : null)
                    ->required(),

                Textarea::make('motif_refus')
                    ->label('Motif du refus')
                    ->visible(fn ($get) => $get('status') === 'refusé')
                    ->required(fn ($get) => $get('status') === 'refusé'),

                TextInput::make('user.name')
                    ->label('Nom de l\'étudiant')
                    ->disabled(),

                TextInput::make('user.etablissement')
                    ->label('Établissement')
                    ->disabled(),

                TextInput::make('pays_destination')
                    ->label('Pays')
                    ->disabled(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Étudiant')->searchable(),
                TextColumn::make('user.etablissement')->label('Établissement')->searchable(),
                TextColumn::make('pays_destination')->label('Pays')->searchable(),
                TextColumn::make('status')->label('Status')->sortable(),
            ])
            ->filters([
                Filter::make('Status')
                    ->query(fn ($query, $data) => $query->where('status', $data))
                    ->form([
                        Select::make('status')
                            ->options([
                                'en attente' => 'En attente',
                                'validé' => 'Validé',
                                'refusé' => 'Refusé',
                            ])
                    ]),
                    Filter::make('Etablissement')
                    ->form([
                        TextInput::make('etablissement'),
                    ])
                    ->query(fn ($query, $data) => $data ? $query->whereHas('user', fn($q) => $q->where('etablissement', 'like', '%' . $data['etablissement'] . '%')) : $query),
                
                    Filter::make('Pays')
                    ->form([
                        TextInput::make('pays_destination'),
                    ])
                    ->query(fn ($query, $data) => $data ? $query->where('pays_destination', 'like', '%' . $data['pays_destination'] . '%') : $query),
                
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMobilites::route('/'),
            'create' => Pages\CreateMobilite::route('/create'),
            'edit' => Pages\EditMobilite::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool
    {
    return false;
    }
}