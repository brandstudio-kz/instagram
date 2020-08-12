<?php

namespace BrandStudio\Instagram\Traits;

trait HasInstagramMedia
{

    public function getAccount()
    {
        return $this->sendRequest('me', [
            'fields' => implode(',', ['id', 'account_type', 'username', 'media_count']),
        ]);
    }

    public function getPosts()
    {
        return $this->sendRequest('me/media', [
            'fields' => implode(',', ['id', 'media_type', 'media_url', 'permalink', 'thumbnail_url']),
        ]);
    }

    public function getFollowersCnt()
    {
        return $this->sendRequest('https://instagram.com/only.kazakhstan', [
            '__a' => 1,
        ])['graphql']['user']['edge_followed_by']['count'];
    }

}
