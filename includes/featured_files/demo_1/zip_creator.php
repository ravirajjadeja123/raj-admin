<?php

//start .zip file creation
// Get real path for our folder
$rootPath = realpath(PROJECT_STORAGE.$result->project_name);

// Initialize archive object
$zip = new ZipArchive();
$zip->open(PROJECT_STORAGE.$result->project_name.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);
foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $result->project_name.'\\'.$relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
//Stop .zip file creation

?>