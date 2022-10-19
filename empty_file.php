$file=storage_path('logs/laravel.log');
        $size=filesize($file);
        $file2 = fopen($file, "a+");
        ftruncate($file2,500);
        fclose($file2);
