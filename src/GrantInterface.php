<?php


namespace Rozeo\OAuth;


interface GrantInterface
{
    public function getResponseType(): string;

    public function getType(): string;

    public function getCredentialParams(): array;
}