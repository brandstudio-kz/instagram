<?php

namespace BrandStudio\Instagram\Console\Commands;

use Illuminate\Console\Command;
use BrandStudio\Instagram\Facades\Instagram;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache instagram account, followers_cnt, and posts.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \Cache::forget('instagram_account');
        \Cache::forget('instagram_followers');
        \Cache::forget('instagram_posts');

        $this->info('Caching instagram account...');
        \Cache::rememberForever('instagram_account', function() {
            return Instagram::getAccount();
        });
        $this->info('Caching instagram followers cnt...');
        \Cache::rememberForever('instagram_followers', function() {
            return Instagram::getFollowersCnt();
        });
        $this->info('Caching instagram posts...');
        \Cache::rememberForever('instagram_posts', function() {
            return Instagram::getPosts();
        });
    }
}
