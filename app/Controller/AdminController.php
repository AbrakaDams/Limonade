<?php 
namespace Controller;

use \W\Controller\Controller;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;

class AdminController extends Controller
{
	public function admin()
	{
		$this->show('admin/admin');
	}
}