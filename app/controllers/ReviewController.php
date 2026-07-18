<?php

final class ReviewController
{
    public function store(): void
    {
        Security::verifyCsrf();

        $user = Auth::user();

        if (!$user) {
            header('Location: index.php?page=login');
            exit;
        }

        $orderId = (int)($_POST['order_id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);
        $comment = trim($_POST['comment'] ?? '');

        Review::create(
            $orderId,
            (int)$user['id'],
            $rating,
            $comment
        );

        header('Location: index.php?page=user_orders');
        exit;
    }
}
