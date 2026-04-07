<?php
$layouts = [
    'resources/views/layouts/SMK/app.blade.php',
    'resources/views/layouts/SMP/app.blade.php',
    'resources/views/layouts/SD/app.blade.php',
];
$bom = "\xEF\xBB\xBF";
foreach ($layouts as $f) {
    $c = file_get_contents($f);
    if (substr($c, 0, 3) === $bom) {
        file_put_contents($f, substr($c, 3));
        echo "Re-stripped BOM: $f\n";
    } else {
        echo "Clean: $f\n";
    }
}
