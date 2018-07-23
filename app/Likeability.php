<?php

namespace App;

trait Likeability
{
    /**
     * A post can be liked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Like the current post.
     */
    public function like()
    {
        $like = new Like(['user_id' => auth()->id()]);

        $this->likes()->save($like);
    }

    /**
     * Unlike the current post.
     */
    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }

    /**
     * Toggle like the currnent post.
     *
     * @return int
     */
    public function toggle()
    {
        if ($this->isLiked()) {
            return $this->unlike();
        }

        return $this->like();
    }

    /**
     * Determine if the current post has been liked.
     *
     * @return bool
     */
    public function isLiked()
    {
        return (bool) $this->likes()
                           ->where('user_id', auth()->id())
                           ->count();
    }

    /**
     * Get the number of likes for the post.
     *
     * @return int
     */
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
