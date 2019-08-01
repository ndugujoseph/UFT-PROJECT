<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTotalPaymentRequest extends FormRequest
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
            'date' => 'required|date_format:'.config('app.date_format').'|unique:total_payment,date',
            'admin' => 'required',
            'agent_low' => 'required',
            'agent_high' => 'required',
            'agent_head_low' => 'required',
            'agent_head_high' => 'required',

        ];
    }
}
