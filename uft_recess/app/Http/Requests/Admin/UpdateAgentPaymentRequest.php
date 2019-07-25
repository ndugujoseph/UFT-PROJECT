<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentPaymentRequest extends FormRequest
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
            
            'date' => 'required|date_format:'.config('app.date_format').'|unique:agent_payments,date,'.$this->route('agent_payments'),
            'highest_erollment' => 'required',
            'other_erollments' => 'required',
        ];
    }
}
