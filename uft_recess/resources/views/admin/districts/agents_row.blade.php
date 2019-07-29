<tr data-index="{{ $index }}">
    <td>{!! Form::text('agents['.$index.'][full_name]', old('agents['.$index.'][full_name]', isset($field) ? $field->full_name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('agents['.$index.'][username]', old('agents['.$index.'][username]', isset($field) ? $field->username: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::email('agents['.$index.'][email]', old('agents['.$index.'][email]', isset($field) ? $field->email: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('agents['.$index.'][gender]', old('agents['.$index.'][gender]', isset($field) ? $field->gender: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('agents['.$index.'][signature]', old('agents['.$index.'][signature]', isset($field) ? $field->signature: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>