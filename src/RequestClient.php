<?php


namespace Rozeo\OAuth;

use GuzzleHttp\Client;

class RequestClient extends Client
{
    /**
     * @var AccessTokenInterface
     */
    private $token;

    public function __construct(AccessTokenInterface $token, array $config = [])
    {
        $this->token = $token;

        if ($this->checkValidToken()) {
            throw new \InvalidArgumentException("Token is invalid.");
        }

        parent::__construct(
            array_merge(
                $config,
                ['headers' => ['Authorization' => "{$token->getTokenType()} {$token->getAccessToken()}"]]
            )
        );
    }

    public function getToken(): AccessTokenInterface
    {
        return $this->token;
    }

    protected function checkValidToken(): bool
    {
        if ($this->token->hasExpired()) {
            throw new \BadMethodCallException('Token has expired.');
        }
        return true;
    }
}