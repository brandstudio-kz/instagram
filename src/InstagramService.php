<?php
namespace BrandStudio\Instagram;

use GuzzleHttp\Client;

class InstagramService
{
    use \BrandStudio\Instagram\Traits\HasInstagramToken;
    use \BrandStudio\Instagram\Traits\HasInstagramMedia;

    protected $config;
    protected $client;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->client = new Client();

        $this->file = storage_path("instagram/tokens.json");
        $this->fetchTokens();
    }



    private function sendRequest($url, array $data = [], $method = 'GET')
    {
        if (!starts_with($url, 'http')) {
            $url = "https://graph.instagram.com/{$url}";
        }

        if (!isset($data['access_token'])) {
            $data['access_token'] = $this->getToken('long')['access_token'];
        }

        try {
            $response = $this->client->request($method, $url, [
                ($method == 'GET' ? 'query' : 'form_params') => $data,
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            try {
                \Log::error($e->getResponse()->getBody()->getContents());
            } catch(\Exception $e) {
                \Log::error($e);
            }
            throw $e;
        }
    }

}
