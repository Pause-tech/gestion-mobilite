<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobiliteResource\Pages;
use App\Models\Mobilite;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class MobiliteResource extends Resource
{
    protected static ?string $model = Mobilite::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Gestion des Mobilités'; // Groupe du menu

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('pays_destination')->label('Pays'),
                Forms\Components\TextInput::make('universite_accueil')->label('Université'),
                Forms\Components\TextInput::make('ville')->label('Ville'),
                Forms\Components\DatePicker::make('date_debut')->label('Date Début'),
                Forms\Components\DatePicker::make('date_fin')->label('Date Fin'),
                Forms\Components\Textarea::make('motivation')->label('Motivation'),
                Forms\Components\Select::make('status')
                    ->label('Statut')
                    ->options([
                        'en attente' => 'En attente',
                        'validé' => 'Validé',
                        'refusé' => 'Refusé'
                    ]),
                Forms\Components\Textarea::make('motif_refus')->label('Motif du refus')->visible(fn ($get) => $get('status') === 'refusé'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Étudiant'),
                Tables\Columns\TextColumn::make('pays_destination')->label('Pays'),
                Tables\Columns\TextColumn::make('universite_accueil')->label('Université'),
                Tables\Columns\TextColumn::make('ville')->label('Ville'),
                Tables\Columns\TextColumn::make('date_debut')->label('Date Début')->date(),
                Tables\Columns\TextColumn::make('date_fin')->label('Date Fin')->date(),
                Tables\Columns\TextColumn::make('justificatif')
                ->label('Justificatif')
                ->formatStateUsing(fn ($state) => $state 
                    ? '<a href="' . asset('storage/' . $state) . '" target="_blank" class="text-blue-500 underline">Voir</a>' 
                    : '<span class="text-gray-500">Aucun</span>')
                ->html(),
                           
                Tables\Columns\TextColumn::make('status')
                ->label('Statut')
                ->formatStateUsing(fn ($state) => match ($state) {
                    'validé' => '✔ Validé',
                    'refusé' => '✘ Refusé',
                    'en attente' => '⏳ En attente',
                    default => $state,
                })
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'validé' => 'success',
                    'refusé' => 'danger',
                    'en attente' => 'warning',
                    default => 'gray',
                }),
            
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'en attente' => 'En attente',
                        'validé' => 'Validé',
                        'refusé' => 'Refusé'
                    ]),
            
                SelectFilter::make('universite_accueil') // ❌ "Université" ne correspond pas à la DB
                    ->label('Université')
                    ->options(fn () => 
                        \App\Models\Mobilite::whereNotNull('universite_accueil')
                            ->distinct()
                            ->pluck('universite_accueil', 'universite_accueil')
                            ->toArray()
                    ),
            
                SelectFilter::make('pays_destination') // ❌ "Pays" ne correspond pas à la DB
                    ->label('Pays')
                    ->options(fn () => 
                        \App\Models\Mobilite::whereNotNull('pays_destination')
                            ->distinct()
                            ->pluck('pays_destination', 'pays_destination')
                            ->toArray()
                    ),
            ])
            
            
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Valider')
                ->label('✅ Valider')
                ->color('success')
                ->action(function ($record) {
                    $record->status = 'validé';
                    $record->save();
                    \Cache::forget('mobilites'); // Vider le cache au cas où
                }),
            
                Tables\Actions\Action::make('Refuser')
                    ->label('❌ Refuser')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('motif_refus')
                            ->label('Motif du refus')
                            ->required()
                    ])
                    ->action(function ($record, $data) {
                        $record->status = 'refusé';
                        $record->motif_refus = $data['motif_refus'];
                        $record->save();
                        \Cache::forget('mobilites'); // Vider le cache au cas où
                    }),
                
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
        return false; // Désactive le bouton "New Mobilite"
    }
        
}
