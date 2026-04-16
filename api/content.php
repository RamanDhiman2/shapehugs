<?php
declare(strict_types=1);

require_once __DIR__ . '/_bootstrap.php';

$catalog = shapehugs_seed_catalog();

shapehugs_json([
    'success' => true,
    'data' => [
        'heroSlides' => $catalog['heroSlides'],
        'benefits' => $catalog['benefits'],
        'collections' => $catalog['collections'],
    ],
]);
