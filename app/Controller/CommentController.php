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
  public function showComments(){
    $comment = new CommentModel();
    $id = 0;
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = intval($_POST['id']);
    }

    $showComment = $comment->findAllComments($id);
    $join = $comment->joinComment($id);
    $this->showJson(['allComments' => $showComment]);
  }

  public function joinComment(){
    $comment = new CommentModel();
    $id = 0;
    $loggedUser = $this->getUser();

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = intval($_POST['id']);
    }

    $showComment = $comment->findAllComments($id);
    $join = $comment->joinComment($id);
    $this->showJson(['allComments' => $join, 'idUser' => $loggedUser['id']]);
  }

  /**
	 *  Ajoute un commentaire
   * @param $id relie l'id users avec l'id commentaire
	 */
  public function insertComment(){
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
        $id = $post['id'];
        $data = [
          'id_event' => $id,
          'id_user' => $user['id'],
          'content' => $post['comment'],
          'date_add' => $date,
        ];
        if($commentaire->insert($data)){
            $this->showJson(['answer' => 'success']);
        }
      }
    }
  }
    public function deleteComment(){
        $idComment = 0;
        if(isset($_POST['idComment']) && !empty($_POST['idComment'])){
            $idComment = $_POST['idComment'];
        }
        $comment = new CommentModel();
        $comment->delete($idComment);
        $this->showJson(['suppression' => 'ok']);

    }
}
