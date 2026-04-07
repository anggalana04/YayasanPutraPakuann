<?php
$files = glob('resources/views/**/*.blade.php') + glob('resources/views/**/**/*.blade.php') + glob('resources/views/**/**/**/*.blade.php');
foreach ($files as $f) {
    $h = bin2hex(substr(file_get_contents($f), 0, 3));
    if ($h === 'efbbbf') {
        echo "BOM: $f\n";
    }
}
echo "Done.\n";
