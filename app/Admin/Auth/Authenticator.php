<?php

namespace App\Admin\Auth;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class Authenticator
{
    private const CLIENT_ID = 2;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * Authenticator constructor.
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @return Client|null
     */
    public function getClient(): ?Client
    {
        return $this->clientRepository->find(static::CLIENT_ID);
    }
}
