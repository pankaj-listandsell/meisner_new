<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateThumbnail extends Command
{
    protected $signature = 'generate:thumbnail';

    protected $description = 'Generate Thumbnail';

    public function handle()
    {
        $imagePaths = [
            '0000/1/2023/07/06/ges-welcome.webp',
            '0000/1/2023/07/06/wash-elephants.webp',
            '0000/1/2023/07/06/elephant-bath.webp',
            '0000/1/2023/07/06/elephant-31.webp',
        ];

        foreach ($imagePaths as $imagePath) {
            generateThumbnail(public_path('uploads/'.$imagePath));
        }

        $this->info('Successfully generated thumbnail');
    }
}
