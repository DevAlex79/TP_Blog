<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

     // Autoriser un lecteur à modifier son propre commentaire
    public function update(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id && $user->isReader();
    }
}
