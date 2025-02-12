<?php

echo "<?xml version=\"1.0\" encoding=\"windows-1252\"?>\n";
render(["version" => "8.4.2"]);

function render(array $data) {
    array_walk_recursive($data, function (&$value) {
        $value = htmlspecialchars($value);
    });
    extract($data);
    include __DIR__ . "/template.php";
}
