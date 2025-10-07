<?php

namespace App\Support;

use App\Models\User;
use Devanych\View\Renderer;

class Template
{
        public static function exists($section, $view = null)
        {
                if ($section) {
                        $path = self::resolvePath($view, $section);
                        if (file_exists($path)) {
                                return true;
                        }
                }

                return false;
        }

        public static function render($section, $view = null, $page = '*')
        {
                $is_page = $page == '*' ? true : Input::is($page);
                $is_page = $page == 'home' && !Input::get('page') ? true : $is_page;

                if ($section && $is_page) {
                        $path = self::resolvePath($view, $section);
                        if (file_exists($path)) {
                                include_once $path;
                        }
                }
        }

        public static function renderer($section, $folder = null, $data = array())
        {
                $renderer = new Renderer(APP_VIEW_PATH);

                $file = $folder ? $folder . '/' . $section : $section;

                $head = $renderer->render('layout/head');
                $foot = $renderer->render('layout/foot');

                $nav = User::isLoggedIn() ? $renderer->render(User::data()->is_tyro ? 'user/_layout/nav' : 'company/layout/nav')
 : null;
                $footer = User::isLoggedIn() ? $renderer->render(User::data()->is_tyro ? 'user/_layout/footer' : 'company/layout/footer') : null;

                $content = $renderer->render($file, $data);

                return $head . $nav . $content . $footer . $foot;
        }

        protected static function resolvePath($view, $section)
        {
                $section = ltrim($section, '/');

                if ($view === null || $view === '' || $view === APP_VIEW_PATH) {
                        $base = APP_VIEW_PATH;
                } elseif (strpos($view, APP_ROOT) === 0) {
                        $base = rtrim($view, '/');
                } else {
                        $base = rtrim(APP_VIEW_PATH . '/' . trim($view, '/'), '/');
                }

                return $base . '/' . $section . '.php';
        }
}
