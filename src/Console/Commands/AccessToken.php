<?php

namespace BrandStudio\Instagram\Console\Commands;

use Illuminate\Console\Command;
use BrandStudio\Instagram\Facades\Instagram;

class ExchangeToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set new short-lived Instagram User Access Token.';

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
        $token = $this->ask('Enter new short-lived Instagram User Access Token');
        try {
            Instagram::setToken($token);
            $this->info("New token: {$token}\n");
        } catch(\Exception $e) {
            $this->error($e);
        }
    }
}
