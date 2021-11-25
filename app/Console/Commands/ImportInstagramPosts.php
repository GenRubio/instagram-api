<?php

namespace App\Console\Commands;

use App\Models\InstagramPost;
use App\Services\InstagramPostService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportInstagramPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:instagram-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        (new InstagramPostService())->importPosts();
    }
}
