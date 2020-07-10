<?php


namespace Rozeo\OAuth;


interface AuthorizeProviderInterface
{
    public function getAuthorizeRedirectUrl(GrantInterface $grant): string;

    public function getAccessToken(GrantInterface $grant): AccessTokenInterface;

    public function refreshAccessToken(AccessTokenInterface $token): AccessTokenInterface;
}