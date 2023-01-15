<?php

namespace Src\Application\User\Infrastructure\Request;

use Illuminate\Contracts\Validation\Validator;
use Src\Application\User\Domain\Exceptions\UserRequestFailedException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    use RequestHelper, HttpCodesHelper;

    public function rules(): array
    {
        return [
            'first_name' => 'nullable|max:45',
            'last_name' => 'nullable|max:45',
            'email' => 'nullable|email|unique:users',
            'cellphone' => 'nullable|max:12',
            'password' => 'nullable|max:125',
            'state_id' => 'nullable|integer'
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     * @throws UserRequestFailedException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new UserRequestFailedException($this->formatErrorsRequest($validator->errors()->all()), $this->badRequest());
    }
}
