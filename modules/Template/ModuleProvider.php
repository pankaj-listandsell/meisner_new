<?php
namespace Modules\Template;

use Modules\ModuleServiceProvider;

class ModuleProvider extends ModuleServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->register(RouterServiceProvider::class);
    }

    public static function getTemplateBlocks(){
        return [
            // 'row'=>"\\Modules\\Template\\Blocks\\Row",
            // 'column'=>"\\Modules\\Template\\Blocks\\Column",
            // 'text'=>"\\Modules\\Template\\Blocks\\Text",
            // 'call_to_action'=>"\\Modules\\Tour\\Blocks\\CallToAction",
            // 'video_player'=>"\\Modules\\Template\\Blocks\\VideoPlayer",
            // 'faqs'=>"\\Modules\\Template\\Blocks\\FaqList",
            // 'list_featured_item'=>"\\Modules\\Tour\\Blocks\\ListFeaturedItem",
            // 'testimonial'=>"\\Modules\\Tour\\Blocks\\Testimonial",
            // 'form_search_all_service'=>"\\Modules\\Template\\Blocks\\FormSearchAllService",
            // 'offer_block'=>"\\Modules\\Template\\Blocks\\OfferBlock",
            // 'how_it_works'=>"\\Modules\\Template\\Blocks\\HowItWork",
            // 'client_feedback'=>"\\Modules\\Template\\Blocks\\ClientFeedBack",
            // 'slider_with_content'=>"\\Modules\\Template\\Blocks\\SliderWithContent",
            // 'grid_with_content'=>"\\Modules\\Template\\Blocks\\GridWithContent",
            // 'carousel'=>"\\Modules\\Template\\Blocks\\Carousel",
            // 'breadcrumb'=>"\\Modules\\Template\\Blocks\\Breadcrumb",

            // other page section
            'banner'=>"\\Modules\\Template\\Blocks\\Template1\\Banner",
            'left_image_right_contant'=>"\\Modules\\Template\\Blocks\\Template1\\LeftImageRightContant",
            'services'=>"\\Modules\\Template\\Blocks\\Template1\\Services",
            'left_contant_right_image'=>"\\Modules\\Template\\Blocks\\Template1\\LeftContantRightImage",
            'any_questions'=>"\\Modules\\Template\\Blocks\\Template1\\AnyQuestions",
            'five_steps'=>"\\Modules\\Template\\Blocks\\Template1\\FiveSteps",
            'request_service'=>"\\Modules\\Template\\Blocks\\Template1\\RequestService",
            'Left_contant_right_image_second'=>"\\Modules\\Template\\Blocks\\Template1\\LeftContantRightImageSecond",
            'why_choice'=>"\\Modules\\Template\\Blocks\\Template1\\WhyChoice",
            'faq'=>"\\Modules\\Template\\Blocks\\Template1\\FAQ",

            //home page section
            'home_banner'=>"\\Modules\\Template\\Blocks\\HomeSection\\HomeBanner",
            'krown_from'=>"\\Modules\\Template\\Blocks\\HomeSection\\KnownFrom",
            'clearance_berlin'=>"\\Modules\\Template\\Blocks\\HomeSection\\ClearanceBerlin",
            'before_after_slider'=>"\\Modules\\Template\\Blocks\\HomeSection\\BeforeAfterSlider",
            'home_services'=>"\\Modules\\Template\\Blocks\\HomeSection\\HomeServices",
            'why_you_choose'=>"\\Modules\\Template\\Blocks\\HomeSection\\WhyYouChoose",
            'home_left_image_right_contant'=>"\\Modules\\Template\\Blocks\\HomeSection\\LeftImageRightContant",
            'uncomplicated_disposal'=>"\\Modules\\Template\\Blocks\\HomeSection\\UncomplicatedDisposal",
            'locations'=>"\\Modules\\Template\\Blocks\\HomeSection\\Locations",
            'counter'=>"\\Modules\\Template\\Blocks\\HomeSection\\Counter",
            'our_process'=>"\\Modules\\Template\\Blocks\\HomeSection\\OurProcess",
            'declutter_cheaply'=>"\\Modules\\Template\\Blocks\\HomeSection\\DeclutterCheaply",
            'testimonials'=>"\\Modules\\Template\\Blocks\\HomeSection\\Testimonials",
            'project_with_us'=>"\\Modules\\Template\\Blocks\\HomeSection\\ProjectWithUs",
            'providing_trusted'=>"\\Modules\\Template\\Blocks\\HomeSection\\ProvidingTrusted",
            'left_image_right_contant_second'=>"\\Modules\\Template\\Blocks\\HomeSection\\LeftImageRightContantSecond",

            //city page section

            'city_banner'=>"\\Modules\\Template\\Blocks\\CityTemplate\\Banner",
            'city_left_image_right_contant'=>"\\Modules\\Template\\Blocks\\CityTemplate\\LeftImageRightContant",
            'city_left_contant_right_image'=>"\\Modules\\Template\\Blocks\\CityTemplate\\LeftContantRightImage",
            'city_counter'=>"\\Modules\\Template\\Blocks\\CityTemplate\\Counter",
            'city_Left_contant_right_image_second'=>"\\Modules\\Template\\Blocks\\CityTemplate\\LeftContantRightImageSecond",
            'city_any_questions'=>"\\Modules\\Template\\Blocks\\CityTemplate\\AnyQuestions",
            'city_why_choice'=>"\\Modules\\Template\\Blocks\\CityTemplate\\WhyChoice",

            //location  section   Services

            'search_city'=>"\\Modules\\Template\\Blocks\\LocationSection\\SearchCity",
            'list_of_locations'=>"\\Modules\\Template\\Blocks\\LocationSection\\ListOfLocations",

             //All Services  section

             'all_services'=>"\\Modules\\Template\\Blocks\\AllServiceSection\\Services",
             'all_services_any_questions'=>"\\Modules\\Template\\Blocks\\AllServiceSection\\AnyQuestions",
             'video'=>"\\Modules\\Template\\Blocks\\AllServiceSection\\Video",
             'clearing_solution'=>"\\Modules\\Template\\Blocks\\AllServiceSection\\ClearingSolution",

        ];
    }
}
