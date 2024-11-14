<?php

namespace App\Classes;

class Metas extends General
{
    private $_db, $_table = 'metas';

    function __construct()
    {
        parent::__construct('metas');
        $this->_db = DB::getInstance();
    }

    public function displayMeta($page = 'home', $action = null, $order_by_field = 'id', $display = true)
    {
        $content = null;
        // $action_search = $action ? "page_action = '{$action}'": "page_action IS";
        $query = $action ? " page = '{$page}' AND page_action = '{$action}' " : " page = '{$page}' ";
        if (!$this->_db->query("SELECT * FROM {$this->_table} WHERE {$query} ORDER BY ? DESC", array($order_by_field))->error()) {

            if (!$this->_db->count()) {
                $home = $this->_db->get($this->_table, array('page', '=', 'home'));
                $data = $home->count() ? $home->first() : null;
            }

            $data = isset($data) ? $data : $this->_db->first();
            if (!$display) {
                return $data;
            }
            $title = $data->title ? $data->title : "Stakepadi";


            $content = "
  			<title>{$title}</title>
            
            <meta name='title' content='{$title}'>
			<meta name='description' content='{$data->description}'>
			<meta name='keywords' content='{$data->keywords}'>
		  
			<!-- Google / Search Engine Tags -->
			<meta itemprop='name' content='{$title}'>
			<meta itemprop='description' content='{$data->description}'>
			<meta itemprop='image' content='{$data->image}'>

			<!--twitter og-->
			<meta name='twitter:site' content='@Stakepadi'>
			<meta name='twitter:creator' content='@Stakepadi'>
			<meta name='twitter:card' content='summary_large_image'>
			<meta name='twitter:title' content='{$title}'>
			<meta name='twitter:description' content='{$data->description}'>
			<meta name='twitter:image' content='{$data->image}'>
		  
			<!--facebook og-->
			<meta property='og:url' content='https://stakepadi.com/'>
			<meta property='og:title' content='{$title}'>
			<meta property='og:description' content='{$data->description}'>
			<meta property='og:image' content='{$data->image}'>
			<meta property='og:image:secure_url' content='{$data->image}'>
			<meta property='og:image:type' content='image/png'>
			<meta property='og:image:width' content='1200'>
			<meta property='og:image:height' content='600'>";

            return $content;
        }
        return $content;
    }
}
