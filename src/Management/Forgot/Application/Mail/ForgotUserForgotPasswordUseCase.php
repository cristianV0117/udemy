<?php

namespace Src\Management\Forgot\Application\Mail;

use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

final class ForgotUserForgotPasswordUseCase
{
    /**
     * @param ForgotMailableContract $forgotMailableContract
     */
    public function __construct(
        private readonly ForgotMailableContract $forgotMailableContract
    )
    {
    }

    public function __invoke(array $request)
    {
        return $this->forgotMailableContract->forgotSendMail(new ForgotMailable($request["email"]));
    }
}
