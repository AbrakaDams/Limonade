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
  public function insertComments(){
    $post = [];
    $error = [];

    if(!empty($_POST)){
			foreach($_POST as $key => $value){
				$post[$key] = trim(strip_tags($value));
			}
      if(empty($post['comment'])){
        $error[] = 'Le commentaire ne peut pas etre vide';
      }
      if(count($error) === 0){
      
      }
  }
}
