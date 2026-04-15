<?php

namespace App\Observers;

use App\Models\Post;
use App\Jobs\SyncPostToElasticJob;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
         \Log::info('Dispatching Elastic job...');
         dispatch(new SyncPostToElasticJob($post, 'index'))->onQueue('elastic');
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {        
        dispatch(new SyncPostToElasticJob($post, 'delete'))->onQueue('elastic');
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
