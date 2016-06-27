<?php /* app/Model/CommentModel.php */
namespace Model;

class EventModel extends \W\Model\Model
{
	//Récupère les commentaires associés à un article
	// public function findPostComments($postId)
	// {
	// 	//...
	// }


	//Cette fonction permet de récupérer les utilisateurs participant à un évènement donné
	public function getEventUsers($id) {

		$sql = 'SELECT * FROM event_users WHERE id_event='.$id;

  		$sth = $this->dbh->prepare($sql);
  		$sth->execute();

  		return $sth->fetchAll();
	}

}
