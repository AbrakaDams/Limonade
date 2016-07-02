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

		return $sth->fetch();
	}

	public function findAllUserEvents($idUser)
	{
		$sql = 'SELECT event.id, event.title, event.date_start, event.date_end, event.description, event.role ,event.address, event.category
		    FROM event_users
		    INNER JOIN event ON event_users.id_event = event.id
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_user=:idUser ORDER BY event.date_start DESC';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idUser', $idUser, PDO::PARAM_INT);
		$sth->execute();

		return $sth->fetchAll();
	}
	public function find2UserEvents($idUser)
	{
		$sql = 'SELECT event.id, event.title, event.date_start, event.date_end, event.description, event.role ,event.address, event.category
		    FROM event_users
		    INNER JOIN event ON event_users.id_event = event.id
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_user=:idUser ORDER BY event.date_start DESC limit 2';

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idUser', $idUser, PDO::PARAM_INT);
		$sth->execute();

		return $sth->fetchAll();
	}


	public function findAllUsers($idEvent, $limit = null) {

		if($limit == null) {
			$sql = 'SELECT users.id, users.username, event_users.role, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent ORDER BY users.username DESC';
		}
		else {
			$sql = 'SELECT users.id, users.username, event_users.role, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent ORDER BY users.username DESC LIMIT '.$limit.'';
		}

	    $sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
	    $sth->execute();

	    return $sth->fetchAll();
	}

	public function findAllBut1Users($idEvent, $idUser, $limit = null) {

		if($limit == null) {
			$sql = 'SELECT users.id, users.username, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent AND users.id != :idUser ORDER BY users.username DESC';
		}
		else {
			$sql = 'SELECT users.id, users.username, users.firstname, users.lastname
		    FROM event_users
		    INNER JOIN users ON event_users.id_user = users.id
		    WHERE event_users.id_event=:idEvent AND users.id != :idUser ORDER BY users.username DESC LIMIT '.$limit.'';
		}

	    $sth = $this->dbh->prepare($sql);
		$sth->bindValue(':idEvent', $idEvent, PDO::PARAM_INT);
		$sth->bindValue(':idUser', $idUser, PDO::PARAM_INT);

	    $sth->execute();

	    return $sth->fetchAll();
	}
}
