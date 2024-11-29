<?php


namespace App\Libraries\Migrator\Db;


use Illuminate\Support\Facades\DB;
use Modules\Files\Entities\Files;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\SliderSlide;
use Modules\Slider\Entities\SliderSlideTranslation;
use Modules\Slider\Entities\SliderTranslation;

class SliderMigrator
{
	use MigratorHelper;

	public static function execute($command)
	{
		Slider::truncate();
		$data = DB::connection('mysql')->table('sliders')->select('*')->get();
        Slider::insert(self::toArray($data));

        SliderTranslation::truncate();
        $data = DB::connection('mysql')->table('slider_translations')->select('*')->get();
        SliderTranslation::insert(self::toArray($data));

        SliderSlide::truncate();
        $data = DB::connection('mysql')->table('slider_slides')->select('*')->get();
        SliderSlide::insert(self::toArray($data));

        SliderSlideTranslation::truncate();
        $data = DB::connection('mysql')->table('slider_slide_translations')->select('*')->get();
        SliderSlideTranslation::insert(self::toArray($data));

		$command->info('Slider, Slide with Translations seeded');
	}

}
