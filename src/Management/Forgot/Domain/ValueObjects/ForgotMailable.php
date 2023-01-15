<?php

namespace Src\Management\Forgot\Domain\ValueObjects;

use Src\Shared\Domain\ValueObjects\StringValueObject;

use stdClass;

final class ForgotMailable extends StringValueObject
{
    /**
     * @var stdClass
     */
    private stdClass $mailObject;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
        $this->mailObject = new stdClass();
        $this->setFrom();
        $this->setSubject();
        $this->setMarkdown();
    }

    /**
     * @return stdClass
     */
    public function getObjectMailable(): stdClass
    {
        return $this->mailObject;
    }

    /**
     * @return void
     */
    private function setFrom(): void
    {
        $this->mailObject->from = 'applicationrestapi@gmail.com';
    }

    /**
     * @return void
     */
    private function setSubject(): void
    {
        $this->mailObject->subject = 'Recuperar contraseña';
    }

    /**
     * @return void
     */
    private function setMarkdown(): void
    {
        $this->mailObject->markdown = 'mails.Forgot';
    }
}
