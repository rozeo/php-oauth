<?php


namespace Rozeo\OAuth\Grant;


use Rozeo\OAuth\GrantInterface;

class Code implements  GrantInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * Code constructor.
     * @param string $code
     */
    public function __construct(string $code = '')
    {
        $this->code = $code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return 'code';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'authorization_code';
    }

    /**
     * @return array<string, mixed>
     * @throws \InvalidArgumentException
     */
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