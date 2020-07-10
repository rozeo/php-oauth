<?php


namespace Rozeo\OAuth;


interface GrantInterface
{
    /**
     * @return string
     */
    public function getResponseType(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return array<string, mixed>
     */
    public function getCredentialParams(): array;
}