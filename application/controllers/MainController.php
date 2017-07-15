<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\URL;


class MainController extends Controller
{
	public function action_index()
	{
		$view = new View();
		$url = new URL();
		
		if($_POST['url'] && $url::inspectionURL(trim($_POST['url'])))
		{
			$str_url = trim($_POST['url']);
			
			if($url->findByColumn('url',$str_url))
			{
				$view->status = 'Ссылка уже существует';
			}
			else
			{
				$view->url = $str_url;
				
				if($_POST['main_url'] && $url::inspectionURL(trim($_POST['main_url'])))
				{
					$view->short_url = trim($_POST['main_url']);
				}
				else
				{
					do 
					{
						$view->short_url = URL::shortiningURL($str_url);
					}
					while($url->findByColumn('shortURL',$view->short_url));
				}

				$url->url = $view->url;
				$url->shortURL = $view->short_url;
				$url->insert(); 
			}
		}
		$view->display('main\index.php');
	}

	public function action_all()
	{
		$view = new View();
		$url = new URL();
		$view->urls = $url->findAll();
		$view->display('main\all.php');
	}

}