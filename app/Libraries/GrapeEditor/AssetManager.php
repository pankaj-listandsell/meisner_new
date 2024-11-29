<?php

namespace App\Libraries\GrapeEditor;

use Dotlogics\Grapesjs\App\Repositories\AssetRepository;
use Illuminate\Support\Facades\Storage;
use Modules\Media\Models\MediaFile;

class AssetManager
{
    public array $assets = [];
    public ?string $upload = null;
    public ?string $uploadName = null;
    public array $headers = [];
    public int $autoAdd = 1;
    public string $uploadText = 'Drop files here or click to upload';
    public string $addBtnText = 'Add image';
    public int $dropzone = 1;
    public int $openAssetsOnDrop = 0;
    public string $modalTitle = 'Upload Images';
    public bool $showUrlInput = false;

    function __construct(AssetRepository $assetRepository)
    {
        $this->headers['X-CSRF-TOKEN'] = csrf_token();
        $this->upload = $assetRepository->getUploadUrl();
        $this->uploadName = 'file';

        $this->assets = $this->getAllMediaLinks();
    }

    /**
     * Get Media links
     *
     * @return array
     */
    public function getAllMediaLinks(): array
    {
        $medias = MediaFile::all();

        $files = [];
        foreach ($medias as $media) {
            if (Storage::disk(config('laravel-grapesjs.assets.disk'))->exists($media->file_path)) {
                $dimension = [];

                if ($media->file_width && $media->file_height) {
                    $dimension = [
                        'width' => $media->file_width,
                        'height' => $media->file_height,
                    ];
                }

                $files[] = array_merge([
                    'type' => 'image',
                    'src' => Storage::disk(config('laravel-grapesjs.assets.disk'))->url($media->file_path),
                    'name' => $media->file_name,
                ], $dimension);
            }
        }

        return $files;
    }
}
