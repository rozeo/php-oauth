<?php


namespace Rozeo\OAuth;


class AccessToken implements AccessTokenInterface
{
    /**
     * @var array<string, mixed>
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
     * @var int
     */
    private $expireIn;

    /**
     * AccessToken constructor.
     * @param array<string, mixed> $params
     */
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
     * @return string
     * @throws \InvalidArgumentException
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

    /**
     * @return bool
     */
    public function hasExpired(): bool
    {
        if ($this->expireIn < 0) {
            return false;
        }

        return time() > $this->expireIn + $this->tokenCreatedAt;
    }

    /**
     * @return array<string, mixed>
     */
    public function getOriginalParams(): array
    {
        return $this->params;
    }
}