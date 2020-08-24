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
        $data = $this->sendRequest('me/media', [
            'fields' => implode(',', ['id', 'media_type', 'media_url', 'permalink', 'thumbnail_url']),
        ]);

        $posts = [];
        foreach(array_slice($data['data'] ?? [], 0, $this->config['posts_cnt']) as $post) {
            $posts[] = [
                'permalink' => $post['permalink'],
                'media_url' => $post['media_type'] == 'VIDEO' ? $post['thumbnail_url'] : $post['media_url'],
            ];
        }

        return $posts;
    }

    public function getFollowersCnt()
    {
        $html = file_get_contents('https://instagram.com/only.kazakhstan/');
        return str_replace('k', '', explode("Followers", explode("meta property=\"og:description\" content=\"", $html)[1])[0]);
    }

}
