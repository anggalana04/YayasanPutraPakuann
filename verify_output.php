<?php
$file = $argv[1] ?? 'temp_check2.html';
$h = file_get_contents($file);
$bom = "\xEF\xBB\xBF";
$count = substr_count($h, $bom);
echo "BOM occurrences: $count\n";

// Check first 200 chars
$first = substr($h, 0, 200);
$firstHex = bin2hex(substr($h, 0, 20));
echo "First 20 bytes hex: $firstHex\n";
echo "First 200 chars: " . str_replace(["\n", "\r"], ["\\n", ""], $first) . "\n";

// Check around main tag
$mainPos = strpos($h, '<main id');
if ($mainPos !== false) {
    $heroPos = strpos($h, 'data-hero-section', $mainPos);
    if ($heroPos !== false) {
        $between = substr($h, $mainPos, $heroPos - $mainPos + 40);
        $between = str_replace(["\n", "\r"], ["\\n", ""], $between);
        echo "\nMain to hero section:\n$between\n";
    }
}

// Check between hero </section> and next <section>
$heroEnd = strpos($h, '</section>', strpos($h, 'data-hero-section'));
if ($heroEnd !== false) {
    $nextSection = strpos($h, '<section', $heroEnd + 10);
    if ($nextSection !== false) {
        $gap = substr($h, $heroEnd, $nextSection - $heroEnd + 30);
        $gap = str_replace(["\n", "\r"], ["\\n", ""], $gap);
        echo "\nGap between hero end and next section:\n$gap\n";
    }
}
