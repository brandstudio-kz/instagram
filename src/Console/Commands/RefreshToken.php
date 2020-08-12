<?php

namespace BrandStudio\Instagram\Console\Commands;

use Illuminate\Console\Command;
use BrandStudio\Instagram\Facades\Instagram;

class AccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh a long-lived Instagram User Access Token that is at least 24 hours old but has not expired. Refreshed tokens are valid for 60 days from the date at which they are refreshed.';

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
        try {
            Instagram::refreshToken();
        } catch(\Exception $e) {
            $this->error($e);
        }
    }
}
