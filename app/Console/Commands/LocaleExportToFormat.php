<?php

namespace App\Console\Commands;

use Custom\Helpers\Traits\LocaleExporter;
use Illuminate\Console\Command;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class LocaleExportToFormat extends Command
{
    /** @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed */
    protected $filepath;

    /** @var array */
    protected $messages;

    /** @var string */
    protected $file_name;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:locale {format=php}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all localization messages to JavaScript file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->messages = LocaleExporter::getLocaleInArray();
        $this->file_name = 'messages';

        $format = $this->argument('format');

        if ($format === 'javascript') {
            $this->toJavaScript();
        }
        if ($format === 'php') {
            $this->toPhpArrayFile();
        }
    }

    protected function toJavaScript()
    {
        $this->filepath = resource_path('jsBundler');
        $filename = $this->file_name.'.js';

        $adapter = new Local($this->filepath);
        $filesystem = new Filesystem($adapter);

        $contents = 'export default ' . json_encode($this->messages);

        if ($filesystem->has($filename)) {
            $filesystem->delete($filename);
            $filesystem->write($filename, $contents);
        } else {
            $filesystem->write($filename, $contents);
        }

        $this->info('Messages exported to JavaScript file in ' . $this->filepath . DIRECTORY_SEPARATOR . $filename);
    }

    protected function toPhpArrayFile()
    {
        $this->filepath = base_path('custom/Helpers/Exporter/Locale');
        $filename = $this->file_name.'.php';

        $adapter = new Local($this->filepath);
        $filesystem = new Filesystem($adapter);

        $contents = '<?php return ' . var_export($this->messages, true) . ';';

        if ($filesystem->has($filename)) {
            $filesystem->delete($filename);
            $filesystem->write($filename, $contents);
        } else {
            $filesystem->write($filename, $contents);
        }

        $this->info('Messages exported to php file in ' . $this->filepath . DIRECTORY_SEPARATOR . $filename);
    }
}
