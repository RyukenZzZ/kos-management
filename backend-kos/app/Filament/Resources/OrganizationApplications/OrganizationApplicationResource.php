<?php

namespace App\Filament\Resources\OrganizationApplications;

use App\Actions\OrganizationApplications\AcceptOrganizationApplication;
use App\Filament\Resources\OrganizationApplications\Pages\ListOrganizationApplications;
use App\Filament\Resources\OrganizationApplications\Pages\ViewOrganizationApplication;
use App\Models\OrganizationApplication;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrganizationApplicationResource extends Resource
{
    protected static ?string $model = OrganizationApplication::class;

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Applications';

    protected static string|\UnitEnum|null $navigationGroup = 'Tenant Management';
    public static function getEloquentQuery(): Builder
    {
        $organizationId = auth()->user()?->organization?->id;

        return parent::getEloquentQuery()
            ->where('organization_id', $organizationId ?? 0)
            ->with(['user', 'reviewer']);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('user.name')->label('Applicant'),
            TextEntry::make('user.email')->label('Email'),
            TextEntry::make('user.phone')->label('Phone')->placeholder('Not provided'),
            TextEntry::make('status')->badge(),
            TextEntry::make('reviewer.name')->label('Reviewed by')->placeholder('Not reviewed'),
            TextEntry::make('reviewed_at')->dateTime()->placeholder('Not reviewed'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Applicant')->searchable()->sortable(),
                TextColumn::make('user.email')->label('Email')->searchable(),
                TextColumn::make('status')->badge()->sortable(),
                TextColumn::make('created_at')->label('Applied')->dateTime()->sortable(),
                TextColumn::make('reviewed_at')->label('Reviewed')->dateTime()->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'pending' => 'Pending',
                    'accepted' => 'Accepted',
                    'rejected' => 'Rejected',
                ]),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('accept')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (OrganizationApplication $record): bool => auth()->user()?->can('review', $record) ?? false)
                    ->action(fn (OrganizationApplication $record) => app(AcceptOrganizationApplication::class)->handle($record, auth()->user())),
                Action::make('reject')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn (OrganizationApplication $record): bool => auth()->user()?->can('review', $record) ?? false)
                    ->action(function (OrganizationApplication $record): void {
                        abort_unless(auth()->user()?->can('review', $record), 403);

                        $record->update([
                            'status' => 'rejected',
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);
                    }),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrganizationApplications::route('/'),
            'view' => ViewOrganizationApplication::route('/{record}'),
        ];
    }
}
