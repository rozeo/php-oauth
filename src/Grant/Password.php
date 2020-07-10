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

    /**
     * Password constructor.
     * @param string $name
     * @param string $password
     */
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return 'password';
    }

    /**
     * @return array<string, mixed>
     * @throws \InvalidArgumentException
     */
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

    /**
     * @param string $name
     * @return $this
     */
    public function setUsername(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}