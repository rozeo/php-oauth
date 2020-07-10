<?php


namespace Rozeo\OAuth;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class RequestClient extends Client
{
    /**
     * @var AccessTokenInterface
     */
    private $token;

    public function __construct(AccessTokenInterface $token, array $config = [])
    {
        $this->token = $token;

        if (!$this->checkValidToken()) {
            throw new \InvalidArgumentException("Token is invalid.");
        }

        $config['headers'] = array_merge(
            $config['headers'] ?? [],
            [
                'Authorization' => "{$this->token->getTokenType()} {$this->token->getAccessToken()}"
            ]
        );

        parent::__construct($config);
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