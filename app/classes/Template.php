<?php

namespace App\Classes;

use Devanych\View\Renderer;
use Models\User;

class Template
{

	public static function exists($section, $view)
	{
		if ($section && $view) {
			if (file_exists($view . '/' . $section . '.php')) {
				return true;
			}
		}
		return false;
	}

	public static function render($section, $view = 'view', $page = '*')
	{
		$is_page = $page == '*' ? true : Input::is($page);
		$is_page = $page == 'home' && !Input::get('page') ? true : $is_page;

		if ($section && $view && $is_page) {
			if (file_exists($view . '/' . $section . '.php')) {
				include_once($view . '/' . $section . '.php');
			}
		}
	}

	public static function renderer($section, $folder = null, $data = array())
	{
		$renderer = new Renderer(APP_VIEW_PATH);

		$file = $folder ? $folder . '/' . $section : $section;

		$head = $renderer->render('layout/head');
		$foot = $renderer->render('layout/foot');

		$nav = User::isLoggedIn() ? $renderer->render(User::data()->is_tyro ? 'user/_layout/nav' : 'company/layout/nav') : null;
		$footer = User::isLoggedIn() ? $renderer->render(User::data()->is_tyro ? 'user/_layout/footer' : 'company/layout/footer') : null;

		$content = $renderer->render($file, $data);

		return $head . $nav . $content . $footer . $foot;
	}
}
