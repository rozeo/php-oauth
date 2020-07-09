<?php


namespace Rozeo\OAuth\Grant;


use Rozeo\OAuth\GrantInterface;

class Code implements  GrantInterface
{
    /**
     * @var string
     */
    private $code;

    public function __construct(string $code = '')
    {
        $this->code = $code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    public function getResponseType(): string
    {
        return 'code';
    }

    public function getType(): string
    {
        return 'authorization_code';
    }

    public function getCredentialParams(): array
    {
        if ($this->code === '') {
            throw new \InvalidArgumentException(
                'Grant code is not set.'
            );
        }

        return [
            'code' => $this->code,
        ];
    }
}