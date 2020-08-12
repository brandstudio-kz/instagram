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
        $html = file_get_contents('https://instagram.com/only.kazakhstan/');
        return str_replace('k', '', explode("Followers", explode("meta property=\"og:description\" content=\"", $html)[1])[0]);
    }

}
