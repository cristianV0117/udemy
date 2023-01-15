<?php

namespace Src\Application\User\Infrastructure\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Src\Application\User\Domain\Exceptions\UserRequestFailedException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Src\Shared\Infrastructure\Helper\RequestHelper;

final class UserStoreRequest extends FormRequest
{
    use RequestHelper, HttpCodesHelper;

    public function rules(): array
    {
        return [
            'first_name' => 'required|max:45',
            'last_name' => 'required|max:45',
            'email' => 'required|email|unique:users',
            'cellphone' => 'nullable|max:12',
            'password' => 'required|max:125',
            'state_id' => 'required|integer'
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
