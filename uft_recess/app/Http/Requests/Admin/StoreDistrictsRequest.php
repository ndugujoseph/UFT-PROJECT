<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreDistrictsRequest extends FormRequest
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
            'name' => 'required|unique:districts,name,'.$this->route('districts'),
            'initials' => 'required|unique:districts,initials,'.$this->route('districts'),
            'region' => 'required',
           // 'agents' => 'max:2147483647|numeric',
           //'members' => 'max:2147483647|numeric',
            'well_wishers.*.first_name' => 'required',
            'well_wishers.*.amount' => 'numeric|required',
            'agents.*.full_name' => 'required',
            'agents.*.username' => 'required|unique:agents,username,'.$this->route('agents'),
            'agents.*.email' => 'required|email|unique:agents,email',
            'agents.*.gender' => 'required',
            'agents.*.signature' => 'required',
        ];
    }
}
