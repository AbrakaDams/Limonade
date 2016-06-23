<?php
namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\NewsFeedModel as NewsFeedModel;

class NewsFeedController extends Controller
{
  public function newsFeed($id){
    $news = new NewsFeedModel();

    $showNews = $news->findAllNews($id);


    return $showNews;

  }
}
