<?php
// Strip BOM from all blade files that have it
$files = array_merge(
    glob('resources/views/**/*.blade.php'),
    glob('resources/views/**/**/*.blade.php'),
    glob('resources/views/**/**/**/*.blade.php')
);

$bom = "\xEF\xBB\xBF";
$fixed = 0;

foreach ($files as $f) {
    $content = file_get_contents($f);
    if (substr($content, 0, 3) === $bom) {
        $content = substr($content, 3);
        file_put_contents($f, $content);
        echo "Fixed: $f\n";
        $fixed++;
    }
}

echo "\nFixed $fixed files.\n";

// Verify
echo "\nVerifying...\n";
foreach ($files as $f) {
    $h = bin2hex(substr(file_get_contents($f), 0, 3));
    if ($h === 'efbbbf') {
        echo "STILL HAS BOM: $f\n";
    }
}
echo "Verification complete.\n";
