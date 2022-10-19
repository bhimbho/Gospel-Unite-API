<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestInputValidator;
class UserRegistrationRequest extends FormRequest
{
    use RequestInputValidator;
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
            'fullname' => 'required| min: 5',
            'password' => 'required',
            'password' => 'required',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'gender' => 'required',
            'nationality' => 'required',
            'device_id' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'phone'=>$this->filterPhoneNumber($this->request->get('phone_code'),$this->request->get('phone'))
        ]);
    }


}
