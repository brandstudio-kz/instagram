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
        $json = file_get_contents('https://instagram.com/only.kazakhstan/?__a=1');
        $json = json_decode($json);
        return $json['graphql']['user']['edge_followed_by']['count'];
    }

}
