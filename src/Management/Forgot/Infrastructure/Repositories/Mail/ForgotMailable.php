<?php

namespace Src\Management\Forgot\Infrastructure\Repositories\Mail;

use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable as ForgotMailableValueObject;
use Illuminate\Support\Facades\Mail;

final class ForgotMailable implements ForgotMailableContract
{
    private Mail $mail;

    public function __construct()
    {
        $this->mail = new Mail();
    }

    /**
     * @param ForgotMailableValueObject $forgotMailable
     * @return Forgot
     */
    public function forgotSendMail(ForgotMailableValueObject $forgotMailable): Forgot
    {
        $response = $this->mail::to($forgotMailable->value())
            ->send(new CustomMail($forgotMailable->getObjectMailable()));

        if (!$response) {
            return new Forgot(null, 'MAIL_FAILED');
        }

        return new Forgot([
            "email" => $forgotMailable->value(),
            "custom" => "mensaje enviado"
        ]);
    }
}
