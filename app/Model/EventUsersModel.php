<?php
namespace Model;
use \PDO;

class EventUsersModel extends \W\Model\Model
{
	//Cette fonction permet de récupérer les utilisateurs participant à un évènement donné
	public function getEventUsers($id) {

		$sql = 'SELECT * FROM  ' . $this->table .' WHERE id_event='.$id;

  		$sth = $this->dbh->prepare($sql);
  		$sth->execute();

  		return $sth->fetchAll();
	}

	public function deleteParticipant($idEvent, $idUser)
	{
		$sql = 'DELETE FROM  ' . $this->table .'  WHERE id_event = :idEvent AND id_user = :idUser';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent);
		$sth->bindValue(':idUser', $idUser);

		return $sth->execute();
	}
	public function findUserInEvent($idEvent, $idUser)
	{
		$sql = 'SELECT * FROM ' . $this->table .' WHERE id_event = :idEvent AND id_user = :idUser';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent);
		$sth->bindValue(':idUser', $idUser);
		$sth->execute();

		return $sth->fetchAll();
	}

	public function findAllUsers($idEvent, $limit = null) {

		if($limit == null) {
			$sql = 'SELECT users.id, users.username, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent ORDER BY users.username DESC';
		}
		else {
			$sql = 'SELECT users.id, users.username, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent ORDER BY users.username DESC LIMIT '.$limit.'';
		}

	    $sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
	    $sth->execute();

	    return $sth->fetchAll();
	}
}
