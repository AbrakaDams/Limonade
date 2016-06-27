<?php
namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\NewsFeedModel as NewsFeedModel;

class NewsFeedController extends Controller
{
  /**
   * Function permettant de rechercher toute les news
   * @param  int $id l'id de la bdd
   */
  public function newsFeed($id){
    $news = new NewsFeedModel();
    $showNews = $news->findAllNews($id);
    return $showNews;
  }
}
