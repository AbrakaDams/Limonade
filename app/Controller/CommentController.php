<?php
namespace Controller;

use \W\Controller\Controller;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;

class CommentController extends Controller
{
  /**
   * Affiche les commentaire
   * @param  $id l'id commentaire
   * @return Tout les commentaires
   */
  public function showComments($id){
    $comment = new NewsFeedModel();

    $showComment = $comment->findAllComment($id);


    return $showComment;
  }

  /**
	 *  Ajoute un commentaire
   * @param $id relie l'id users avec l'id commentaire
	 */
  public function insertComment($id){
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
        $commentaire = new CommentModel();

        $date = date("Y-m-d H:i:s");

        $user = $this->getUser();

        $data = [
          'id_event' => $id,
          'id_user' => $user['id'],
          'content' => $post['comment'],
          'date_add' => $date,
        ];
        $insertComment = $commentaire->insert($data);
      }
    }
  }

  
  /**
   * Affiche les commentaire
   * @param  $id l'id commentaire
   * @return Tout les commentaires
   */
  public function showAllComments($id){
    $importComment = new CommentModel();

    $comment = $importComment->findAll($id);

    return $comment;
  }


}
