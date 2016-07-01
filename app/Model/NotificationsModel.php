<?php
namespace Model;

class NotificationsModel extends \W\Model\Model
{

	/**
	 * Récupère les notifications d'un utilisateur donné
	 * @param int $idUser l'id de l'utilisateur
	 * @param int $limit Le nombre de notification à récuperer
	 */
	public function findAllByUser($idUser, $limit = 10){

		if(empty($idUser)){
			return false; // Si l'id user n'est pas fourni
		}


		$sql = 'SELECT * FROM ' . $this->table .' WHERE id_user = :id_user ORDER BY date_create DESC';
		if(!empty($limit)){
			$sql.= ' LIMIT :limit';
		}

		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_user', $idUser);
		if(!empty($limit)){
			$sth->bindValue(':limit', $limit, \PDO::PARAM_INT);
		}
		$sth->execute();

		return $sth->fetchAll();
	}

	public function updateNotif($read, $id){
		echo $read;
		echo $id;
		if(empty($data) || empty($id)){
			return false; // S'il manque une des 2 infos
		}

		$sql = 'UPDATE ' . $this->table . ' SET read = "read" WHERE id = :id';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':read', $read);
		$sth->bindValue(':id', $id);		
		$sth->execute();

		if(!$sth->execute()){
			return false;
		}

		return $this->find($id);
	}
	public function exist(array $data)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user AND id_event = :id_event AND content = :content AND is_read = :is_read LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_user', $data['id_user']);
		$sth->bindValue(':id_event', $data['id_event']);
		$sth->bindValue(':content', $data['content']);
		$sth->bindValue(':is_read', $data['is_read']);
		if($sth->execute()){
			return $sth->fetch();
		}
		else{
			return false;
		}
	}
	public function haveUnreadNotif($id_user)
	{
		$sql = 'SELECT * FROM ' . $this->table . ' WHERE id_user = :id_user AND is_read = :is_read';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id_user', $id_user);
		$sth->bindValue(':is_read', 'unread');
		if($sth->execute()){
			return $sth->fetch();
		}
		else{
			return false;
		}
	}
}