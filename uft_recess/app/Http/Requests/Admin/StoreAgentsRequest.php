<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgentsRequest extends FormRequest
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
            'full_name' => 'required',
            'username' => 'required|unique:agents,username,'.$this->route('agents'),
            
            'email' => 'required|email|unique:agents,email',
            'gender' => 'required',
            'signature' => 'required',
        ];
    }
}
