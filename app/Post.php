<?php

namespace App;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $casts = [
        'published'    => 'boolean',
        'archived'     => 'boolean',
        'seo_keywords' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(PostObserver::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeArchived(Builder $query)
    {
        return $query->where('archived', true);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return mixed
     */
    public function scopeByCategory(Builder $query, $value = [])
    {
        return $query->whereIn('category_id', $value);
    }

    /**
     * @param Builder $query
     * @return mixed
     */
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy('updated_at', 'desc')->take(10);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return mixed
     */
    public function scopeRelatedPost(Builder $query, $value)
    {
        return $query->where('body', 'like', '%' . $value . '%')->take(6);
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return mixed
     */
    public function scopeHashId(Builder $query, $value)
    {
        return $query->where('hash_id', $value);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return mixed
     */
    public function scopeSlug(Builder $query, $value)
    {
        return $query->where('slug', $value);
    }

    /**
     * @return mixed
     */
    public function togglePublished()
    {
        if ($this->published) {

            return $this->forceFill(['published' => false]);
        }

        return $this->forceFill(['published' => true]);
    }
}
