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
}