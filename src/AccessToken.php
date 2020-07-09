<?php


namespace Rozeo\OAuth;


class AccessToken implements AccessTokenInterface
{
    /**
     * @var array
     */
    private $params;
    /**
     * @var string
     */
    private $accessToken;
    /**
     * @var string|null
     */
    private $refreshToken;
    /**
     * @var string
     */
    private $tokenType;

    /**
     * @var int
     */
    private $tokenCreatedAt;

    /**
     * @var int|mixed
     */
    private $expireIn;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->tokenCreatedAt = time();
        $this->accessToken = $this->params['access_token'];
        $this->refreshToken = $this->params['refresh_token'] ?? null;
        $this->tokenType = $this->params['token_type'];
        $this->expireIn = $this->params['expires_in'] ?? -1;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): string
    {
        if ($this->refreshToken === null) {
            throw new \InvalidArgumentException('Refresh Token is not set.');
        }
        return $this->refreshToken;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function hasExpired(): bool
    {
        if ($this->expireIn < 0) {
            return false;
        }

        return time() > $this->expireIn + $this->tokenCreatedAt;
    }

    public function getOriginalParams(): array
    {
        return $this->params;
    }
}