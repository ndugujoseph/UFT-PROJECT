<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTresuariesRequest extends FormRequest
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
            'date' => 'required|date_format:'.config('app.date_format'),
            'amount' => 'numeric|required',
            'total' => 'numeric|required',
        ];
    }
}

/*
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTresuariesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *//*
    public function rules()
    {
        return [
            'date' => 'required|date_format:'.config('app.date_format'),
            'amount' => 'required',
          //  'amount.*' => 'exists:well_wishers,id',
            'total' => 'required',
        ];
    }
}
