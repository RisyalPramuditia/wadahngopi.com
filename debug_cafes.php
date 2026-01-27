<?php
use App\Models\Cafe;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$cafes = Cafe::all()->map(fn($c) => [
    'name' => $c->name,
    'image_path' => $c->image_path,
    'images' => $c->images,
    'status' => $c->status
]);

file_put_contents('debug_cafes.json', $cafes->toJson(JSON_PRETTY_PRINT));
echo "Debug data saved to debug_cafes.json\n";
