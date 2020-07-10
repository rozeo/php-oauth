<?php


namespace Rozeo\OAuth;


use GuzzleHttp\Client as Client;

class AuthorizeProvider implements AuthorizeProviderInterface
{
    /**
     * @var OAuthCredentialsInterface
     */
    private $credentials;

    /**
     * @var Client
     */
    private $client;

    public function __construct(OAuthCredentialsInterface $credentials)
    {
        $this->credentials = $credentials;
        $this->client = new Client([
            'http_errors' => false,
        ]);
    }

    /**
     * @param GrantInterface $grant
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getAuthorizeRedirectUrl(GrantInterface $grant): string
    {
        if ($grant->getResponseType() === '') {
            throw new \InvalidArgumentException(get_class($grant) . " has no response type.");
        }

        return $this->credentials->getAuthorizeUrl() . '?' . http_build_query([
            'redirect_uri' => $this->credentials->getRedirectUri(),
            'response_type' => $grant->getResponseType(),
            'client_id' => $this->credentials->getClientToken(),
            'scope' => join(' ', $this->credentials->getScopes()),
            'format' => 'json',
        ]);
    }

    /**
     * @param GrantInterface $grant
     * @return AccessTokenInterface
     * @throws AuthorizeException
     */
    public function getAccessToken(GrantInterface $grant): AccessTokenInterface
    {
        return $this->_getAccessToken(
            array_merge([
                'client_id' => $this->credentials->getClientToken(),
                'client_secret' => $this->credentials->getClientSecret(),
                'redirect_uri' => $this->credentials->getRedirectUri(),
                'grant_type' => $grant->getType(),
                'scope' => join(' ', $this->credentials->getScopes()),
            ], $grant->getCredentialParams()
            )
        );
    }

    /**
     * @param AccessTokenInterface $token
     * @return AccessTokenInterface
     * @throws AuthorizeException
     */
    public function refreshAccessToken(AccessTokenInterface $token): AccessTokenInterface
    {
        if (!$token->hasExpired()) {
            throw new \InvalidArgumentException('Token has not expired yet.');
        }

        return $this->_getAccessToken([
            'client_id' => $this->credentials->getClientToken(),
            'client_secret' => $this->credentials->getClientSecret(),
            'redirect_uri' => $this->credentials->getRedirectUri(),
            'code' => $token->getRefreshToken(),
            'grant_type' => 'refresh_token',
            'scope' => join(' ', $this->credentials->getScopes()),
        ]);
    }

    /**
     * @param array<string, mixed> $params
     * @return AccessTokenInterface
     * @throws AuthorizeException
     */
    protected function _getAccessToken(array $params): AccessTokenInterface
    {
        $response = $this->client->post(
            $this->credentials->getAccessTokenUrl(),
            ['form_params' => $params]
        );

        if ($response->getStatusCode() !== 200) {
            throw new AuthorizeException(
                'Failed fetch access token. response: ' . $response->getBody()
            );
        }

        return $this->makeAccessToken($response->getBody());
    }

    protected function makeAccessToken(string $body): AccessTokenInterface
    {
        return new AccessToken(
            json_decode($body, true)
        );
    }
}