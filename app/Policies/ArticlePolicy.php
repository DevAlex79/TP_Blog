<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id || $user->isSuperAdmin();
    }

    // Autoriser la suppression d'un article uniquement s'il n'a jamais eu de commentaires
    public function delete(User $user, Article $article)
    {
        return $article->comments->isEmpty() || $user->isAdmin() || $user->isSuperAdmin();
        return $user->id === $article->user_id && $article->comments()->count() === 0;
    }
}
