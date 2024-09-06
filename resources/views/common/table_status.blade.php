@if($model->{$status_attribute ?? 'status'} == ($status_active ?? 'active') || in_array($model->{$status_attribute ?? 'status'}, array_merge(['active', 'paid', 'success'], $active_statuses ?? [])))
<span class="badge badge-success">@lang('word.' . $model->{$status_attribute ?? 'status'})</span>

@elseif($model->{$status_attribute ?? 'status'} == ($status_pending ?? 'pending') || in_array($model->{$status_attribute ?? 'status'}, array_merge([], $pending_statuses ?? [])))
<span class="badge badge-warning">@lang('word.' . $model->{$status_attribute ?? 'status'})</span>

@elseif($model->{$status_attribute ?? 'status'} == ($status_completed ?? 'completed') || in_array($model->{$status_attribute ?? 'status'}, array_merge([], $completed_statuses ?? [])))
<span class="badge badge-success">@lang('word.' . $model->{$status_attribute ?? 'status'})</span>

@elseif($model->{$status_attribute ?? 'status'} == ($status_error ?? 'error') || in_array($model->{$status_attribute ?? 'status'}, array_merge(['rejected', 'unread', 'trashed'], $error_statuses ?? [])))
<span class="badge badge-danger">@lang('word.' . $model->{$status_attribute ?? 'status'})</span>

@else
<span class="badge badge-secondary">@lang('word.' . $model->{$status_attribute ?? 'status'})</span>

@endif