<?php


namespace Rozeo\OAuth;


interface OAuthCredentialsInterface
{
    /**
     * @return string
     */
    public function getClientToken(): string;

    /**
     * @return string
     */
    public function getClientSecret(): string;

    /**
     * @return string
     */
    public function getRedirectUri(): string;

    /**
     * @return string
     */
    public function getAuthorizeUrl(): string;

    /**
     * @return string
     */
    public function getAccessTokenUrl(): string;

    /**
     * @return array<string>
     */
    public function getScopes(): array;
}