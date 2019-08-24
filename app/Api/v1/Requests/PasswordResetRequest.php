<?php

namespace App\Api\v1\Requests;

use App\Services\Contracts\PasswordResetContract;

class PasswordResetRequest extends BaseRequest implements PasswordResetContract {
    const EMAIL = "email";
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
            self::EMAIL => 'required|exists:users,email'
        ];
    }

    public function getEmail() {
        return $this->get(self::EMAIL);
    }
}