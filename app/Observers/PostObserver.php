<?php

namespace App\Observers;

use App\Post;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class PostObserver
{
    /**
     * @param Post $post
     */
    public function created(Post $post)
    {
        return Post::where('id', $post->id)
            ->update([
                'hash_id' => Hashids::encode($post->id),
                'slug'    => $this->sluggedString($post->title)]);
    }

    /**
     * @param Post $post
     */
    public function saved(Post $post)
    {
        return Post::where('id', $post->id)
            ->update([
                'hash_id' => Hashids::encode($post->id),
                'slug'    => $this->sluggedString($post->title)]);
    }

    /**
     * @param $value
     */
    protected function sluggedString($value)
    {
        return Str::slug($value);
    }
}
