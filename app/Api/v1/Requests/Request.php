<?php

namespace App\Api\v1\Requests;

use Dingo\Api\Http\FormRequest;

class Request extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
        ];
    }

    public function messages() {
        return [
        ];
    }
}