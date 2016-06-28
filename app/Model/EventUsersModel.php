<?php 
namespace Model;

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
}