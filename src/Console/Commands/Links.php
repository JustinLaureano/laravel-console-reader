<?php

namespace Jmlaureano\LaravelConsoleReader\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Links extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:link {sub}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return a list of links for the provided sub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $res = Http::get('https://old.reddit.com/r/'. $this->argument('sub') .'.json');

        $content = $res->json();

        foreach ($content['data']['children'] as $post) {
            $data = $post['data'];

            $this->info($data['title']);
            $this->info( substr_replace($data['url'], '', -1) );
            $this->newLine();
        }
    }
}
