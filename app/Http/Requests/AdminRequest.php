<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Rules\NumDash;

class CustomersRequest extends FormRequest
{
    /**
     * Determine if the customer is authorized to make this request.
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
        $id = $this->route()->parameter('id');
        return [
            'id' => 'required|exists:customers,id',
            'user_id' => 'required',
            'name' => 'required|string',
            'subname' => 'required|string',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('customers', 'email')->whereNull('deleted_at')->ignore($id),
            ],
            'postalcode' =>  ['required','string',new NumDash()],
            'address' => 'required|string',
            'tel' => ['required','string',new NumDash()],
            'birthday' => ['required','date'],
        ];
    }
    
    public function messages()
    {
        return [
            
        ];
    }

    /**
     * [override] バリデーション失敗時ハンドリング
     *
     * @param Validator $validator
     * @throw HttpResponseException
     * @see FormRequest::failedValidation()
     */
    protected function failedValidation( Validator $validator )
    {
        $response['data']    = [];
        $response['status']  = 'NG';
        $response['summary'] = '入力に誤りがあります。';
        $response['errors']  = $validator->errors()->toArray();

        throw new HttpResponseException(
            response()->json( $response, 422 )
        );
    }
}
