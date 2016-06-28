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

    public function insertEventUsers(array $data, $stripTags = true)
    {
   		$colNames = array_keys($data);
		$colNamesString = implode(', ', $colNames);

		$sql = 'INSERT INTO event_users(' . $colNamesString . ') VALUES (';
		foreach($data as $key => $value){
			$sql .= ":$key, ";
		}
		// Supprime les caractères superflus en fin de requète
		$sql = substr($sql, 0, -2);
		$sql .= ')';

		$sth = $this->dbh->prepare($sql);
		foreach($data as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			$sth->bindValue(':'.$key, $value);
		}

		if (!$sth->execute()){
			return false;
		}
		return $this->find($this->lastInsertId());
	}

	// Montre les events publics sur la page d'accueil non connecté
	public function getEventPublic($role)
	{
		$sql = 'SELECT * FROM ' . $this->table .' WHERE role = :role ORDER BY date_start ASC' ;
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':role', $role);		
		$sth->execute();

		return $sth->fetchAll();
	}
	
	public function deleteParticipant($idEvent, $idUser)
	{
		$sql = 'DELETE FROM event_users WHERE id_event = :idEvent AND id_user = :idUser';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent);
		$sth->bindValue(':idUser', $idUser);

		return $sth->execute();
	}

}
