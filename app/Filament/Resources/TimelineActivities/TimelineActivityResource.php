<?php

namespace App\Filament\Resources\TimelineActivities;

use App\Filament\Resources\TimelineActivities\Pages\CreateTimelineActivity;
use App\Filament\Resources\TimelineActivities\Pages\EditTimelineActivity;
use App\Filament\Resources\TimelineActivities\Pages\ListTimelineActivities;
use App\Filament\Resources\TimelineActivities\Pages\ViewTimelineActivity;
use App\Filament\Resources\TimelineActivities\Schemas\TimelineActivityForm;
use App\Filament\Resources\TimelineActivities\Schemas\TimelineActivityInfolist;
use App\Filament\Resources\TimelineActivities\Tables\TimelineActivitiesTable;
use App\Models\TimelineActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimelineActivityResource extends Resource
{
    protected static ?string $model = TimelineActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'type';

    public static function form(Schema $schema): Schema
    {
        return TimelineActivityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TimelineActivityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TimelineActivitiesTable::configure($table);
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
            'index' => ListTimelineActivities::route('/'),
            'create' => CreateTimelineActivity::route('/create'),
            'view' => ViewTimelineActivity::route('/{record}'),
            'edit' => EditTimelineActivity::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
