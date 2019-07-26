<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'title' => 'required',
            'agents.*.full_name' => 'required',
            'agents.*.username' => 'required|unique:agents,username,'.$this->route('agents'),
            'agents.*.email' => 'required|email|unique:agents,email,'.$this->route('agents'),
            'agents.*.gender' => 'required',
            'agents.*.signature' => 'required',
        ];
    }
}