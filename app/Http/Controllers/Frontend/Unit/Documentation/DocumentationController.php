<?php

namespace Phoenix\Http\Controllers\Frontend\Unit\Documentation;

use Illuminate\Http\Request;
use Phoenix\Http\Controllers\Controller;
use Phoenix\Models\Unit\Documentation\Category;
use Phoenix\Models\Unit\Documentation\Page;
use Phoenix\Models\Unit\Documentation\Section;

/**
 * Class DocumentationController
 * @package Phoenix\Http\Controllers\Frontend\Unit\Documentation
 */
class DocumentationController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sidebar = $this->getSidebar();
        return view('frontend.documentation.index',['sidebar' => $sidebar]);
    }

    /**
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSection(Section $section)
    {
        $sidebar = $this->getSidebar($section->category->id);
        return view('frontend.documentation.getSection',['sidebar' => $sidebar, 'section' => $section]);
    }

    /**
     * @param Section $section
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPage(Section $section, Page $page)
    {
        $sidebar = $this->getSidebar($section->id);
        return view('frontend.documentation.getPage',['sidebar' => $sidebar, 'section' => $section, 'page' => $page]);
    }


    /**
     *
     * @param null $activeCategory
     * @return \Illuminate\Support\Collection
     */
    public function getSidebar($activeCategory = null)
    {
        $categories = Category::all();
        $sidebar = collect();
        // Lets create the menu
        // TODO: Most likely need to cache this
        foreach ($categories as $category)
        {
            $submenu = collect();
            foreach ($category->sections as $section) {
                $submenu->push([
                    'icon' => $section->icon,
                    'link' => route('documentation.section.get',$section->id),
                    'name' => $section->name
                ]);
            }
            // Set the default collapsed
            $collapsed = true;

            // Lets deal with the collapse here
            if(isset($activeCategory))
            {
                if($activeCategory == $category->id)
                    $collapsed = false;
            }
            $sidebar->push([
                'id' => str_slug($category->name, '-'),
                'slug' => '#'.str_slug($category->name, '-'),
                'name' => $category->name,
                'icon' => $category->icon,
                'submenu' => $submenu,
                'collapsed' => $collapsed
            ]);

        }
        return $sidebar;
    }
}
