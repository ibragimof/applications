<?php

namespace Quinton\Applications\Tables;

use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\EmailBulkChange;
use Botble\Table\BulkChanges\PhoneBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\BulkChanges\TextBulkChange;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\DateColumn;
use Botble\Table\Columns\EmailColumn;
use Botble\Table\Columns\EnumColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\LinkableColumn;
use Botble\Table\Columns\PhoneColumn;
use Botble\Table\Columns\StatusColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Quinton\Applications\Enums\ApplicationStatusEnum;
use Quinton\Applications\Exports\ApplicationExport;
use Quinton\Applications\Models\Application;

class ApplicationTable extends TableAbstract
{
    protected string $exportClass = ApplicationExport::class;

    public function setup(): void
    {
        $this
            ->model(Application::class)
            ->addActions([
                EditAction::make()->route('applications.edit'),
                DeleteAction::make()->route('applications.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                LinkableColumn::make('first_name')->route('applications.edit')
                    ->title(trans('plugins/applications::application.form.full_name'))
                    ->searchable(false)
                    ->getValueUsing(function (LinkableColumn $column) {
                        $item = $column->getItem();

                        return $item->name ?? '-';
                    })
                    ->withEmptyState(),
                EmailColumn::make()->hidden()->linkable()->withEmptyState(),
                PhoneColumn::make()->linkable()->withEmptyState(),
                StatusColumn::make(),
                EnumColumn::make('gender')->title(trans('plugins/applications::application.form.gender'))->hidden(false),
                Column::make('citizenship')->hidden()->title(trans('plugins/applications::application.form.citizenship')),
                DateColumn::make('date_of_birth')->dateFormat('Y-m-d H:i')->hidden()->title(trans('plugins/applications::application.form.date_of_birth')),
                Column::make('country')->hidden()->title(trans('plugins/applications::application.form.country')),
                Column::make('region')->hidden()->title(trans('plugins/applications::application.form.region')),
                Column::make('address')->title(trans('plugins/applications::application.form.address'))->hidden(),
                Column::make('known_languages')->hidden()->title(trans('plugins/applications::application.form.languages')),
                Column::make('education_university')->hidden()->title(trans('plugins/applications::application.form.university')),
                EnumColumn::make('education_degree')->hidden()->title(trans('plugins/applications::application.form.degree')),
                Column::make('education_faculty')->hidden()->title(trans('plugins/applications::application.form.faculty')),
                Column::make('education_specialization')->hidden()->title(trans('plugins/applications::application.form.specialization')),
                Column::make('additional_education')->hidden()->title(trans('plugins/applications::application.form.additional_education')),
                FormattedColumn::make('education_diploma_file')->hidden()->title(trans('plugins/applications::application.form.diploma'))
                    ->getValueUsing(function (FormattedColumn $column) {
                        $item = $column->getItem();

                        return $item->education_diploma_file ? Storage::disk('public')->url($item->education_diploma_file) : '';
                    }),
                DateColumn::make('education_started_at')->dateFormat('Y-m-d H:i')->hidden()->title(trans('plugins/applications::application.form.education_started_at')),
                DateColumn::make('education_ended_at')->dateFormat('Y-m-d H:i')->hidden()->title(trans('plugins/applications::application.form.education_ended_at')),
                Column::make('work_experience_last_workplace')->hidden()->title(trans('plugins/applications::application.form.last_workplace')),
                Column::make('work_experience_later_workplaces')->hidden()->title(trans('plugins/applications::application.form.later_workplaces')),
                Column::make('work_experience_position')->hidden()->title(trans('plugins/applications::application.form.position')),
                DateColumn::make('work_experience_started_at')->dateFormat('Y-m-d H:i')->hidden()->title(trans('plugins/applications::application.form.work_experience_started_at')),
                DateColumn::make('work_experience_ended_at')->dateFormat('Y-m-d H:i')->hidden()->title(trans('plugins/applications::application.form.work_experience_ended_at')),
                FormattedColumn::make('cv_file')->hidden()->title(trans('plugins/applications::application.form.cv_file'))
                    ->getValueUsing(function (FormattedColumn $column) {
                        $item = $column->getItem();

                        return $item->cv_file ? Storage::disk('public')->url($item->cv_file) : '';
                    })
                ,
                Column::make('social_activity_organization')->hidden()->title(trans('plugins/applications::application.form.organization')),
                Column::make('social_activity_type')->hidden()->title(trans('plugins/applications::application.form.type')),
                Column::make('motivation_essay')->hidden()->title(trans('plugins/applications::application.form.motivation_essay')),
                Column::make('value_proposition_essay')->hidden()->title(trans('plugins/applications::application.form.value_proposition_essay')),
                Column::make('benefit_essay')->hidden()->title(trans('plugins/applications::application.form.benefit_essay')),
                Column::make('is_available_full_time')->hidden()->title(trans('plugins/applications::application.form.is_available_full_time')),
                Column::make('can_attend_summer_institute')->hidden()->title(trans('plugins/applications::application.form.can_attend_summer_institute')),
                Column::make('agreed_to_terms')->hidden()->title(trans('plugins/applications::application.form.agreed_to_terms')),
                CreatedAtColumn::make()->width(120)->dateFormat('Y-m-d H:i'),
            ])
            ->addBulkChanges([
                TextBulkChange::make()->name('first_name')->title(trans('plugins/applications::application.form.first_name')),
                TextBulkChange::make()->name('middle_name')->title(trans('plugins/applications::application.form.middle_name')),
                TextBulkChange::make()->name('last_name')->title(trans('plugins/applications::application.form.last_name')),
                EmailBulkChange::make(),
                PhoneBulkChange::make(),
                StatusBulkChange::make()->choices(ApplicationStatusEnum::labels()),
                CreatedAtBulkChange::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('application.applications.destroy'),
            ])
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'created_at',
                        'first_name',
                        'last_name',
                        'middle_name',
                        'email',
                        'gender',
                        'citizenship',
                        'date_of_birth',
                        'phone',
                        'country',
                        'region',
                        'address',
                        'known_languages',
                        'education_university',
                        'education_degree',
                        'education_faculty',
                        'education_specialization',
                        'additional_education',
                        'education_diploma_file',
                        'education_started_at',
                        'education_ended_at',
                        'work_experience_last_workplace',
                        'work_experience_later_workplaces',
                        'work_experience_position',
                        'work_experience_started_at',
                        'work_experience_ended_at',
                        'cv_file',
                        'social_activity_organization',
                        'social_activity_type',
                        'motivation_essay',
                        'value_proposition_essay',
                        'benefit_essay',
                        'is_available_full_time',
                        'can_attend_summer_institute',
                        'agreed_to_terms',
                        'status',
                    ]);
            })
            ->onAjax(function (self $table) {
                return $table->toJson(
                    $table
                        ->table
                        ->eloquent($table->query())
                        ->filter(function ($query) {
                            if ($keyword = $this->request->input('search.value')) {
                                $keyword = '%' . $keyword . '%';

                                return $query
                                    ->where(function ($q) use ($keyword) {
                                        $q->whereRaw("CONCAT(last_name, ' ', first_name, ' ', middle_name) LIKE ?", [$keyword])
                                            ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [$keyword])
                                            ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", [$keyword]);
                                    })
                                    ->orWhere('email', 'LIKE', $keyword)
                                    ->orWhere('phone', 'LIKE', $keyword)
                                    ->orWhere('status', 'LIKE', $keyword);
                            }

                            return $query;
                        })
                );
            });

    }

    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
