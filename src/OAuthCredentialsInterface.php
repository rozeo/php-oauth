<?php


namespace Rozeo\OAuth;


interface OAuthCredentialsInterface
{
    public function getClientToken(): string;

    public function getClientSecret(): string;

    public function getRedirectUri(): string;

    public function getAuthorizeUrl(): string;

    public function getAccessTokenUrl(): string;

    public function getScopes(): array;

    // public function
}