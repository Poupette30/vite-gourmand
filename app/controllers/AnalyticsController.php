<?php

class AnalyticsController
{
    public function index(): void
    {
        Auth::requireRole(['administrateur']);

        try {
            $config = require __DIR__ . '/../config/config.php';

            /*
             * 1. Connexion à MySQL
             */
            $dbConfig = $config['db'];

            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                $dbConfig['host'],
                $dbConfig['port'],
                $dbConfig['name'],
                $dbConfig['charset']
            );

            $pdo = new PDO(
                $dsn,
                $dbConfig['user'],
                $dbConfig['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );

            /*
             * 2. Calcul des statistiques réelles depuis MySQL
             */
            $sql = "
                SELECT
                    m.id AS menu_id,
                    m.title AS menu_title,
                    COUNT(o.id) AS orders_count,
                    COALESCE(SUM(o.total), 0) AS revenue,
                    YEAR(o.service_date) AS period
                FROM orders o
                INNER JOIN menus m ON m.id = o.menu_id
                WHERE o.status = 'terminee'
                GROUP BY
                    m.id,
                    m.title,
                    YEAR(o.service_date)
                ORDER BY orders_count DESC
            ";

            $mysqlStats = $pdo->query($sql)->fetchAll();

            /*
             * 3. Connexion à MongoDB Railway
             */
            $manager = new MongoDB\Driver\Manager(
                $config['mongo_uri']
            );

            $namespace = $config['mongo_database']
                . '.orders_by_menu';

            /*
             * 4. Remplacement des anciennes statistiques MongoDB
             *    par les valeurs actuelles issues de MySQL
             */
            $bulk = new MongoDB\Driver\BulkWrite();

            // On supprime les statistiques précédentes.
            $bulk->delete([], ['limit' => 0]);

            // On insère les statistiques recalculées.
            foreach ($mysqlStats as $stat) {
                $bulk->insert([
                    'menu_id' => (int) $stat['menu_id'],
                    'menu_title' => $stat['menu_title'],
                    'orders_count' => (int) $stat['orders_count'],
                    'revenue' => (float) $stat['revenue'],
                    'period' => (string) $stat['period'],
                ]);
            }

            $manager->executeBulkWrite($namespace, $bulk);

            /*
             * 5. Lecture des statistiques depuis MongoDB
             *    pour les afficher dans la vue
             */
            $query = new MongoDB\Driver\Query([], [
                'sort' => ['orders_count' => -1]
            ]);

            $cursor = $manager->executeQuery(
                $namespace,
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
