<?php
	namespace Modules\Core\Walkers;
	use Illuminate\Support\Str;
    use Modules\Page\Models\Page;
    use Modules\Page\Models\PageTranslation;

    class MenuWalker
	{
		protected static $currentMenuItem;
		protected $menu;
		protected $activeItems = [];

		public function __construct($menu)
		{
			$this->menu = $menu;
		}

        protected function getItemsWithUrl($items, $lang)
        {
            $page_ids = $this->getPageIds($items);

            if (count($page_ids) == 0) {
                return $items;
            }

            if ($lang == get_default_lang()) {
                $pages = Page::whereIn('id', $page_ids)->get();
                $pageTranslations = collect([]);
            } else {
                $pages = Page::whereIn('id', $page_ids)->get();
                $pageTranslations = PageTranslation::whereIn('origin_id', $page_ids)->get();
            }

            foreach ($items as $index=>$page) {
                if (isset($page['id'])) {
                    $items[$index]['slug'] = $this->getSlugFromPage($page['id'], $pages, $pageTranslations);
                    $items[$index]['slug_affix'] = $this->getSlugAffixFromPages($page['id'], $pages, $pageTranslations);
                }
                if (isset($page['children']) && count($page['children']) > 0) {
                    $childrenPages = $this->getChildrenPageWithUrl($page['children'], $pages, $pageTranslations);
                    $items[$index]['children'] = $childrenPages;
                }
            }

            //dd($items);
            return $items;
        }

        public function getChildrenPageWithUrl($childPages, $pages, $pageTranslations): array
        {
            foreach ($childPages as $index=>$page) {
                if (isset($page['id'])) {
                    $childPages[$index]['slug'] = $this->getSlugFromPage($page['id'], $pages, $pageTranslations);
                    $childPages[$index]['slug_affix'] = $this->getSlugAffixFromPages($page['id'], $pages, $pageTranslations);

                    if (isset($page['children']) && count($page['children']) > 0) {
                        $childrenPages = $this->getChildrenPageWithUrl($page['children'], $pages, $pageTranslations);
                        $childPages[$index]['children'] = $childrenPages;
                    }
                }
            }

            return $childPages;
        }


        public function getSlugFromPage($pageId, $pages, $pageTranslations)
        {
            $pageUrl = '';

            foreach ($pages as $page) {
                if ($page->id == $pageId) {
                    $pageUrl = $page->slug;
                }
            }

            foreach ($pageTranslations as $pageTranslation) {
                if ($pageTranslation->origin_id == $pageId) {
                    if ($pageTranslation->slug != '') {
                        $pageUrl = $pageTranslation->slug;
                    }
                }
            }

            return $pageUrl;
        }

        public function getSlugAffixFromPages($pageId, $pages, $pageTranslations)
        {
            $slugAffix = '';

            foreach ($pages as $page) {
                if ($page->id == $pageId) {
                    if (isset($page->slug_affix)) {
                        $slugAffix = $page->slug_affix;
                    }
                }
            }

            foreach ($pageTranslations as $pageTranslation) {
                if ($pageTranslation->origin_id == $pageId) {
                    if (isset($pageTranslation->slug_affix)) {
                        $slugAffix = $pageTranslation->slug;
                    }
                }
            }

            return $slugAffix;
        }


        public function getPageIds($pages)
        {
            $page_ids = [];

            foreach ($pages as $page) {
                if (isset($page['id'])) {
                    $page_ids[] = $page['id'];
                    $childrenPageIds = [];

                    if (isset($page['children']) && count($page['children']) > 0) {
                        $childrenPageIds = $this->getChildrenPageIds($page['children']);
                    }

                    $page_ids = array_merge($page_ids, $childrenPageIds);
                }
            }

            return $page_ids;
        }

        public function getChildrenPageIds($pages): array
        {
            $page_ids = [];

            foreach ($pages as $page) {
                if (isset($page['id'])) {
                    $page_ids[] = $page['id'];

                    $childrenPageIds = [];

                    if (isset($page['children']) && count($page['children']) > 0) {
                        $childrenPageIds = $this->getChildrenPageIds($page['children']);
                    }

                    $page_ids = array_merge($page_ids, $childrenPageIds);
                }
            }

            return $page_ids;
        }


        public function getMenuItems() {
            return json_decode($this->menu->items, true);
        }

		public function generate($lang = '')
		{
            if ($lang == '') {
                $lang = get_current_lang();
            }

			$items = $this->getMenuItems();

            if (!empty($items)) {
                $items = $this->getItemsWithUrl($items, $lang);
                echo '<ul class="main-menu menu-generated">';
				$this->generateTree($items, $lang);
				echo '</ul>';
			}
		}

		public function generateTree($items = [], $locale = '', $depth = 0, $parentKey = '')
		{
            if ($locale == '') {
                $locale = get_current_lang();
            }

			foreach ($items as $k=>$item) {
				$class = e($item['class'] ?? '');
				$item['target'] = $item['target'] ?? '';
				if (!isset($item['item_model']))
					continue;

				if (isset($item['slug']) && $this->checkCurrentMenu($item, $item['slug']))
				{
					$class .= ' active';
					$this->activeItems[] = $parentKey;
				}

				if (!empty($item['children'])) {
					ob_start();
					$this->generateTree($item['children'],$locale, $depth + 1,$parentKey.'_'.$k);
					$html = ob_get_clean();
					if(in_array($parentKey.'_'.$k,$this->activeItems)){
						$class.=' active ';
					}
				}
				$class.=' depth-'.($depth);
				printf('<li class="%s">', $class);
				if (!empty($item['children'])) {
					$item['name'] .= ' <i class="caret icon-angle-down"></i>';
				}

                if ($item['item_model'] == 'custom' && isset($item['has_content']) && $item['has_content'] == 1) {
                    printf('%s', $item['content'] ?? '');
                } else {
                    printf('<a  target="%s" href="%s" >%s</a>', e($item['target']), (($locale == get_default_lang() ? '/' : '/'.$locale.'/').ltrim($item['slug'] ?? '').(isset($item['slug_affix']) ? '/'.$item['slug_affix'] : '')), clean($item['name']));
                }
				if (!empty($item['children'])) {
					echo '<ul class="children-menu menu-dropdown">';
					echo $html;
					echo "</ul>";
				}
				echo '</li>';
			}
		}

		protected function checkCurrentMenu($item, $slug = '')
		{
            if ($item['item_model'] == 'custom') {
                if(trim($slug,'/') == request()->path()) {
                    return true;
                }
            } else {
                if(trim($slug,'/') == request()->url()) {
                    return true;
                }
            }

			if (!static::$currentMenuItem)
				return false;
			if (empty($item['item_model']))
				return false;
			if (is_string(static::$currentMenuItem) and ($slug == static::$currentMenuItem or $slug == url(static::$currentMenuItem))) {
				return true;
			}
			if (is_object(static::$currentMenuItem) and get_class(static::$currentMenuItem) == $item['item_model'] && static::$currentMenuItem->id == $item['id']) {
				return true;
			}

			return false;
		}

		public static function setCurrentMenuItem($item)
		{
			static::$currentMenuItem = $item;
		}

		public static function getActiveMenu()
		{
			return static::$currentMenuItem;
		}
	}
