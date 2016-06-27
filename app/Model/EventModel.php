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

	public function findFullEventInfo($id) {

        $sql = 'SELECT *
                FROM event
                INNER JOIN list ON event.id = list.id_event
                INNER JOIN cards ON list.id = cards.id_list
                WHERE list.id_event='.$id;

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }

}
