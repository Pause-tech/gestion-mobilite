<?php

namespace App\Filament\Widgets;

use App\Models\Mobilite;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MobiliteStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Demandes validées', Mobilite::where('status', 'validé')->count())
                ->description('Total des mobilités approuvées')
                ->color('success'),
                
            Stat::make('Demandes refusées', Mobilite::where('status', 'refusé')->count())
                ->description('Total des mobilités refusées')
                ->color('danger'),
                
            Stat::make('Demandes en attente', Mobilite::where('status', 'en attente')->count())
                ->description('Demandes non traitées')
                ->color('warning'),
                
            Stat::make('Total des demandes', Mobilite::count())
                ->description('Toutes les demandes de mobilité')
                ->color('primary'),
        ];
    }
}