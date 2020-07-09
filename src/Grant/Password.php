<?php


namespace Rozeo\OAuth\Grant;


use Rozeo\OAuth\GrantInterface;

class Password implements GrantInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $password;

    public function __construct(string $name = '', string $password = '')
    {
        $this->name = $name;
        $this->password = $password;
    }

    /**
     * no using response type.
     * @return string
     */
    public function getResponseType(): string
    {
        return '';
    }

    public function getType(): string
    {
        return 'password';
    }

    public function getCredentialParams(): array
    {
        if ($this->name === '') {
            throw new \InvalidArgumentException('Username is not set.');
        }

        if ($this->password === '') {
            throw new \InvalidArgumentException('Password is not set or empty.');
        }

        return [
            'username' => $this->name,
            'password' => $this->password,
        ];
    }

    public function setUsername(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}