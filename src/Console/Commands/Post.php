<?php

namespace Jmlaureano\LaravelConsoleReader\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Post extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:post {post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return the replies for the given post';

    /**
     * Indentation depth for replies
     * @var integer
     */
    const DEPTH = 4;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $res = Http::get($this->argument('post') .'.json');

        $content = $res->json();

        $this->info($content[0]['data']['children'][0]['data']['title']);
        $this->newLine();
        $this->info($content[0]['data']['children'][0]['data']['selftext']);
        $this->newLine();

        foreach ($content[1]['data']['children'] as $reply) {
            $data = $reply['data'];

            $this->info(str_pad('', 60, '#', STR_PAD_LEFT));
            $this->info('Author: '. $data['author']);
            $this->newLine();   
            $this->info($data['body']);
            $this->newLine();

            $this->replies($data['replies'], Post::DEPTH);

            $this->newLine();
        }
    }

    public function replies(array|string $replies, $depth = 0)
    {
        if (gettype($replies) == 'string') {
            return;
        }

        foreach ($replies['data']['children'] as $reply) {
            $data = $reply['data'];

            $padding = str_pad('', $depth, ' ', STR_PAD_LEFT);
            $reply = str_replace("\n\n", "\n\n".$padding, $data['body']);
            $reply = str_replace("\n", "\n".$padding, $data['body']);

            $this->info($padding . 'Reply from '. $data['author']);
            $this->info($padding . $reply);

            $this->newLine();

            $this->replies($data['replies'], $depth + Post::DEPTH);
        }
    }
}
