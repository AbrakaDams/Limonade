<?php
namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\EventModel as EventModel;

class NewsFeedController extends Controller
{
  public function newsFeed($id){
    $news = new EventModel();

    $showNews = $news->find($id);

    return $news;

  }
}
