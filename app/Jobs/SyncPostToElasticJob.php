<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use Elastic\Elasticsearch\ClientBuilder;
use GuzzleHttp\Client;

class SyncPostToElasticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $action; // index | delete

    public $tries = 3;

    public function __construct(Post $post, string $action = 'index')
    {
        $this->post = $post;
        $this->action = $action;
    }

    public function handle()
    {

        $client = ClientBuilder::create()
            ->setHosts(['http://elasticsearch_service:9200']) // 🔴 ESTE ES EL NOMBDE DEL container_name
            ->setHttpClient(new Client([
                'timeout' => 5,
            ]))
            ->setRetries(3)
            ->build();

        // 🔥 test de conexión
        // $info = $client->info();


        if ($this->action === 'delete') {
            $client->delete([
                'index' => 'posts',
                'id' => $this->post->id,
            ]);
            return;
        }

        // 👉 index / update
        $client->index([
            'index' => 'posts',
            'id' => $this->post->id,
            'body' => [
                'title' => $this->post->title,
                'content' => $this->post->content,
                'user_id' => $this->post->user_id,
                'institucion_id' => $this->post->institucion_id,
                'deleted_at' => $this->post->deleted_at,
            ]
        ]);
    }
}