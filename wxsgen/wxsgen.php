<?php

echo "<?xml version=\"1.0\" encoding=\"windows-1252\"?>\n";
render([
    "version" => "8.4.2",
    "product_code" => gen_uuid(),
]);

function render(array $data) {
    array_walk_recursive($data, function (&$value) {
        $value = htmlspecialchars($value);
    });
    extract($data);
    include __DIR__ . "/template.php";
}

function gen_uuid() {
    $rand = random_bytes(16);
    $rand[6] = chr(ord($rand[6]) & 0x0f | 0x40);
    $rand[8] = chr(ord($rand[8]) & 0x3f | 0x80);
    $uuid = strtoupper(bin2hex($rand));
    return substr($uuid, 0, 8) . "-" . substr($uuid, 8, 4) . "-"
        . substr($uuid, 12, 4) . "-" . substr($uuid, 16, 4) . "-"
        . substr($uuid, 20, 12);
}
