<?php

namespace BrandStudio\Instagram\Traits;

trait HasInstagramToken
{
    protected $file;
    protected $tokens = [
        'short' => null,
        'long'  => null,
    ];

    public function getToken($type = 'short')
    {
        return $this->tokens[$type];
    }

    public function setToken($token, string $type = 'short')
    {
        $this->tokens[$type] = $token;
        if ($type == 'short') {
            $this->exchangeToken();
        } else {
            $this->tokens[$type]['created_at'] = now();
            $this->updateFile();
        }
    }

    public function refreshToken()
    {
        if (!$this->getToken('long')) {
            throw new \Exception('Invalid long-lived access token.');
        }

        $response = $this->sendRequest('refresh_access_token', [
            'grant_type' => 'ig_exchange_token',
        ]);
        $this->setToken($response, 'long');
    }


    public function exchangeToken()
    {
        if (!$this->getToken('short')) {
            throw new \Exception('Invalid short-lived access token.');
        }

        $response = $this->sendRequest('access_token', [
            'grant_type' => 'ig_exchange_token',
            'client_secret' => $this->config['client_secret'],
            'access_token' => $this->getToken('short'),
        ]);
        $this->setToken($response, 'long');
    }

    private function fetchTokens()
    {
        try {
            $json = file_get_contents($this->file);
        } catch (\Exception $e) {
            $this->updateFile();
            $json = file_get_contents($this->file);
        }

        $json = json_decode($json, true);

        $this->tokens = $json;
    }

    private function updateFile()
    {
        file_put_contents($this->file, json_encode($this->tokens));
    }
}
