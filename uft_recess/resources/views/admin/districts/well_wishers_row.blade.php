<tr data-index="{{ $index }}">
    <td>{!! Form::text('well_wishers['.$index.'][first_name]', old('well_wishers['.$index.'][first_name]', isset($field) ? $field->first_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('well_wishers['.$index.'][amount]', old('well_wishers['.$index.'][amount]', isset($field) ? $field->amount: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>
