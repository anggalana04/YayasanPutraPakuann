<?php
$h = file_get_contents('temp_check.html');
$bom = "\xEF\xBB\xBF";
$count = substr_count($h, $bom);
echo "BOM occurrences in rendered HTML: $count\n";

$pos = 0;
$i = 1;
while (($pos = strpos($h, $bom, $pos)) !== false) {
    $line = substr_count(substr($h, 0, $pos), "\n") + 1;
    $before = substr($h, max(0, $pos - 60), 60);
    $after = substr($h, $pos + 3, 60);
    $before = str_replace(["\n", "\r"], "\\n", $before);
    $after = str_replace(["\n", "\r"], "\\n", $after);
    echo "BOM #$i at line $line:\n";
    echo "  BEFORE: ...$before\n";
    echo "  AFTER:  $after...\n";
    echo "\n";
    $pos++;
    $i++;
}
