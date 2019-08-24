<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\PasswordResetByCodeContract;

class PasswordResetByCodeRequest extends BaseRequest implements PasswordResetByCodeContract{
    const CODE = "code";
    const PASSWORD = "password";

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
            self::CODE     => 'required',
            self::PASSWORD => 'required|between:4,15|confirmed'
        ];
    }

    public function getCode() {
        return $this->get(self::CODE);
    }

    public function getPassword() {
        return $this->get(self::PASSWORD);
    }
}