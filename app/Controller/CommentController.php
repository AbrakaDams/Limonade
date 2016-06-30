<?php
namespace Controller;

use \W\Controller\Controller;
use \W\Model\UsersModel as UsersModel;
use \Model\CommentsModel as CommentModel;
use \Model\NewsFeedModel as NewsFeedModel;
use \Model\EventModel as EventModel;
use \Model\EventUsersModel as EventUsersModel;
use \Model\NotificationsModel;

class CommentController extends Controller
{
  /**
   * Affiche les commentaire
   * @param  $id l'id commentaire
   * @return Tout les commentaires
   */
  public function showComments(){
        $loggedUser = $this->getUser();
        if(!isset($loggedUser)){
            $this->redirectToRoute('default_home');
        }
        else{
            $comment = new CommentModel();
            $id = 0;
            if(isset($_POST['id']) && !empty($_POST['id'])){
                $id = intval($_POST['id']);
            }

            $showComment = $comment->findAllComments($id);
            $join = $comment->joinComment($id);
            $this->showJson(['allComments' => $showComment]);
        }
    }

  public function joinComment(){
    $loggedUser = $this->getUser();
    if(!isset($loggedUser)){
      $this->redirectToRoute('default_home');
    }
    else{
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
  }

  /**
   *  Ajoute un commentaire
   * @param $id relie l'id users avec l'id commentaire
   */
  public function insertComment(){
    $loggedUser = $this->getUser();
    if(!isset($loggedUser)){
        $this->redirectToRoute('default_home');
    }
    else{
        $post = [];
        $error = [];
        $json = $json = ['answer' => 'raté'];

        if(!empty($_POST)){
          foreach($_POST as $key => $value){
            $post[$key] = trim(strip_tags($value));
          }
          if(empty($post['comment'])){
            $error[] = 'Le commentaire ne peut pas être vide';
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
              // On prépare l'insertion de la notification
              $notificationsModel = new NotificationsModel();
              $eventUsersModel = new EventUsersModel();
              // On récupère tous les utilisateurs dans l'évènement.
              $usersInEvent = $eventUsersModel->findAllBut1Users($id, $user['id']);

              $eventModel = new EventModel();
              // On récupère les données de l'évènement (donc le titre)
              $dataEvent = $eventModel->find($id);

              $phraseType = 'Il y a eut un ou plusieurs commendaires dans l\'évènement : ';
              $phraseType .= $dataEvent['title'];
                $json = $json = ['answer' => ''];

              foreach ($usersInEvent as $userInEvent) {
                $dataVerif = [
                  'id_user'     => $userInEvent['id'],
                  'id_event'    => $id,
                  'content'     => $phraseType,
                  'is_read'     => 'unread',
                ];

                $dataUpdate = [
                  'date_create' => $date,
                ];

                if($exist = $notificationsModel->exist($dataVerif)){
                  $notificationsModel->update($dataUpdate, $exist['id']);
                    $json = ['answer' => 'success'];
                }
                else{
                  $dataNotification = [
                    'id_user'     => $userInEvent['id'],
                    'id_event'    => $id,
                    'content'     => $phraseType,
                    'is_read'     => 'unread',
                    'date_create' => $date,
                  ];
                  $notificationsModel->insert($dataNotification);
                  $json = ['answer' => 'success'];
                }
              }
            }
          }
          else{
            $json = ['answer' => 'err'];
          }
        $this->showJson($json);
        }
    }
  }
    public function deleteComment(){
        $loggedUser = $this->getUser();
        if(!isset($loggedUser)){
          $this->redirectToRoute('default_home');
        }
        else{
            $idComment = 0;
            if(isset($_POST['idComment']) && !empty($_POST['idComment'])){
                $idComment = $_POST['idComment'];
            }
            $comment = new CommentModel();
            $comment->delete($idComment);
            $this->showJson(['suppression' => 'ok']);
        }
    }
}
