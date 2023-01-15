<?php

namespace Src\Management\Forgot\Domain\Contracts;

use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

interface ForgotMailableContract
{
    /**
     * @param ForgotMailable $forgotMailable
     * @return Forgot
     */
    public function forgotSendMail(ForgotMailable $forgotMailable): Forgot;
}
