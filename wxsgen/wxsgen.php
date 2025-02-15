<?php

if ($argc !== 3) {
    echo "usage: {$argv[0]} <indir> <outfile>\n";
    exit(1);
}

$dir = $argv[1];
$version = exec("$dir\\php.exe -r \"echo PHP_VERSION;\"");
$int_size = exec("$dir\\php.exe -r \"echo PHP_INT_SIZE;\"");
$program_files = ($int_size == 8) ? "ProgramFiles64Folder" : "ProgramFilesFolder";
[$dirs, $files] = dirs_and_files($dir);
$data = [
    "version" => $version,
    "program_files" => $program_files,
    "product_code" => gen_uuid(),
    "license" => __DIR__ . "/../misc/license.rtf",
    "banner" => __DIR__ . "/../misc/banner.bmp",
    "dialog" => __DIR__ . "/../misc/dialog.bmp",
    "downgrade_error" => "A newer version of PHP is already installed. To downgrade, first uninstall that version manually.",
    "dir" => $dir,
    "dirs" => $dirs,
    "files" => $files,
];
ob_start();
echo "<?xml version=\"1.0\" encoding=\"windows-1252\"?>\n";
render($data);
file_put_contents($argv[2], ob_get_clean());

function dirs_and_files(string $dir): array {
    $dirs = ["" => ["INSTALLDIR", null], "\\" => ["INSTALLDIR", null]];
    $files = [];
    $it = new RecursiveDirectoryIterator($dir);
    $itit = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::SELF_FIRST);
    foreach ($itit as $file) {
        if ($itit->isDot()) continue;
        if ($itit->isDir()) {
            $id = "dir" . (count($dirs) - 2);
            $subdir = substr($file, strlen($dir));
            $parent = $dirs[dirname($subdir)][0];
            $dirs[$subdir] = [$id, $parent, basename($subdir)];
            continue;
        }
        $subdir = substr($file, strlen($dir), -(strlen($file->getFilename()) + 1));
        $files[] = [substr($file, strlen($dir)), $dirs[$subdir][0], gen_uuid()];
    }
    unset($dirs[""], $dirs["\\"]);
    return [$dirs, $files];
}

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
