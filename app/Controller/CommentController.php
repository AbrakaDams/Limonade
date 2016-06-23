<?php
namespace Controller;

use \W\Controller\Controller;
use \Controller\ListController;
use \Model\NewsFeedModel as NewsFeedModel;

class CommentController extends Controller
{
  public function showComments($id){
    $comment = new NewsFeedModel();

    $showComment = $comment->findAllComment($id);


    return $showComment;
  }
}
