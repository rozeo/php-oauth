<?php


namespace Rozeo\OAuth;


interface AccessTokenInterface
{
    /**
     * @return string
     */
    public function getAccessToken(): string;

    /**
     * @return string
     */
    public function getRefreshToken(): string;

    /**
     * @return string
     */
    public function getTokenType(): string;

    /**
     * @return bool
     */
    public function hasExpired(): bool;

    /**
     * @return array<string, mixed>
     */
    public function getOriginalParams(): array;
}