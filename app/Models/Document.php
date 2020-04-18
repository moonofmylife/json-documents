<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Models\UuidPrimaryKey;

class Document extends Model
{
    use UuidPrimaryKey;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'json'
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 'draft'
    ];

    /**
     * Indicates if all mass assignment is enabled.
     *
     * @var bool
     */
    protected static $unguarded = true;

    /**
     * Publish document.
     *
     * @param bool $save
     * @return Document
     */
    public function publish(bool $save = true)
    {
        $this->setAttribute('status', 'published');

        if ($save) {
            $this->save();
        }

        return $this;
    }

    /**
     * Checking whether the document is published or not.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->getAttribute('status') === 'published';
    }

    /**
     * Scope a query to only include published documents.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyPublished(Builder $query)
    {
        return $query->whereStatus('published');
    }

    /**
     * Scope a query to only include draft documents.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyDraft(Builder $query)
    {
        return $query->whereStatus('draft');
    }
}
