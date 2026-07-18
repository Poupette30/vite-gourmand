<?php

class AnalyticsController
{
    public function index(): void
    {
        Auth::requireRole(['administrateur']);

        try {
            $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

            $query = new MongoDB\Driver\Query([], [
                'sort' => ['orders_count' => -1]
            ]);

            $cursor = $manager->executeQuery(
                'vite_gourmand_stats.orders_by_menu',
                $query
            );

            $stats = [];

            foreach ($cursor as $document) {
                $stats[] = $document;
            }

            View::render('admin/analytics', [
                'stats' => $stats,
                'error' => null
            ]);
        } catch (Throwable $e) {
            View::render('admin/analytics', [
                'stats' => [],
                'error' => $e->getMessage()
            ]);
        }
    }
}
