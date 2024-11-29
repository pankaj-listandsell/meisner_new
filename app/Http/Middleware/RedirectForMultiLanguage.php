<?php
	/**
	 * Created by PhpStorm.
	 * User: Admin
	 * Date: 7/11/2019
	 * Time: 4:54 PM
	 */

	namespace App\Http\Middleware;

    use Closure;
    use Modules\News\Models\News;
    use Modules\Page\Models\Page;

    class RedirectForMultiLanguage
	{
		/**
		 * Handle an incoming request.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  \Closure $next
		 * @param  string|null $guard
		 * @return mixed
		 */
		public function handle($request, Closure $next, $guard = null)
		{
			if (strtolower($request->method()) === 'get' and $request->query('set_lang')) {

				$locale = $request->get('set_lang');
				$slug = $request->route('slug');
                $branch = $request->route('branch');

                if (!in_array($locale, $this->getActiveLanguagesCode())) {
                    return redirect()->back();
                }

                if (get_current_lang() == $locale) {
                    return redirect()->back();
                }

                $previous_lang = get_current_lang();

                $langSlug = '';

                if (in_array($locale, get_language_codes()) && get_default_lang() !== $locale) {
                    $langSlug = $locale;
                }

                set_locale_session($locale);

                $path = $request->path();

                if (in_array($path, get_language_codes()) || $path == '/') {
                    return redirect()->to($langSlug);
                }

                if ($customPageSlug = getMatchedFromPageUrls($path, get_custom_frontend_routes())) {
                    return redirect()->to($customPageSlug);
                }

                if ($this->hasBlogUrls($path)) {
                    $blogTranslation = null;

                    if (get_default_lang() == $locale) {
                        $blogTranslation = News::select('core_news.slug')
                            ->join('core_news_translations', 'core_news.id', 'core_news_translations.origin_id')
                            ->where('core_news_translations.locale', $previous_lang)
                            ->where('core_news_translations.slug', $slug)
                            ->first();
                    } else {
                        $blogTranslation = News::select('core_news_translations.slug')
                            ->join('core_news_translations', 'core_news.id', 'core_news_translations.origin_id')
                            ->where('core_news_translations.locale', $locale)
                            ->where('core_news.slug', $slug)
                            ->first();
                    }

                    if ($blogTranslation && $blogTranslation->slug) {
                        return redirect()->to(route('news.detail', ['slug' => $blogTranslation->slug]));
                    }
                }

                $pageTranslation = null;

                if (get_default_lang() == $locale) {
                    $pageTranslation = Page::select('core_pages.slug', 'core_pages.slug_affix')
                        ->join('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
                        ->where('core_page_translations.locale', $previous_lang)
                        ->where('core_page_translations.slug', $slug)
                        ->where(function ($query) use ($branch) {
                            if ($branch != '') {
                                $query->where('core_page_translations.slug_affix', $branch);
                            } else {
                                $query->where('core_page_translations.slug_affix', '=', NULL)
                                    ->orWhere('core_page_translations.slug_affix', '=', '');
                            }
                        })
                        ->first();
                } else {
                    $pageTranslation = Page::select('core_page_translations.slug', 'core_page_translations.slug_affix')
                        ->join('core_page_translations', 'core_pages.id', 'core_page_translations.origin_id')
                        ->where('core_page_translations.locale', $locale)
                        ->where('core_pages.slug', $slug)
                        ->where(function ($query) use ($branch) {
                            if ($branch != '') {
                                $query->where('core_pages.slug_affix', $branch);
                            } else {
                                $query->where('core_pages.slug_affix', '=', NULL)
                                    ->orWhere('core_pages.slug_affix', '=', '');
                            }
                        })
                        ->first();
                }

                if ($pageTranslation) {
                    return redirect()->to($langSlug.'/'.$pageTranslation->slug.((string) $pageTranslation->slug_affix != '' ? '/'.$pageTranslation->slug_affix : ''));
                }

                return redirect()->to($slug);
			}

			return $next($request);
		}

        public function hasBlogUrls($path): bool
        {
            $paths = explode("/", trim($path));
            return $paths[0] == config('news.news_frontend_route_prefix');
        }

        public function getActiveLanguagesCode(): array
        {
            $activeLanguages = \Modules\Language\Models\Language::getActive();
            return (array) $activeLanguages->pluck('locale')->toArray();
        }

	}
