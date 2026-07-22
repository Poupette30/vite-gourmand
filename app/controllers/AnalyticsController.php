<?php

class AnalyticsController
{
    public function index(): void
    {
        Auth::requireRole(['administrateur']);

        try {
            $config = require __DIR__ . '/../config/config.php';

            $manager = new MongoDB\Driver\Manager(
                $config['mongo_uri']
            );

            $query = new MongoDB\Driver\Query([], [
                'sort' => ['orders_count' => -1]
            ]);

            $cursor = $manager->executeQuery(
                $config['mongo_database'] . '.orders_by_menu',
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
