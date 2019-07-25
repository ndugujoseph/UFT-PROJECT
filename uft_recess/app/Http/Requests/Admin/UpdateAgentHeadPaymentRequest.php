<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentHeadPaymentRequest extends FormRequest
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
            
            'date' => 'required|date_format:'.config('app.date_format').'|unique:agent_head_payment,date,'.$this->route('agent_head_payment'),
            'highest_erollment' => 'required',
            'lowest_erollment' => 'required',
        ];
    }
}
