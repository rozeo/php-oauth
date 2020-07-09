<?php


namespace Rozeo\OAuth;


interface AccessTokenInterface
{
    public function getAccessToken(): string;

    public function getRefreshToken(): string;

    public function getTokenType(): string;

    public function hasExpired(): bool;

    public function getOriginalParams(): array;
}