<?php /* app/Model/CommentModel.php */
namespace Model;

class EventModel extends \W\Model\Model
{

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

	// Montre les events publics sur la page d'accueil non connecté
	public function getEventPublic($role)
	{
		$sql = 'SELECT * FROM ' . $this->table .' WHERE role = :role ORDER BY date_start ASC' ;
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':role', $role);
		$sth->execute();

		return $sth->fetchAll();
	}
	public function find5UsersInEvent(array $ids, $limit){

		if (!is_numeric($id)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->primaryKey .'  = :id LIMIT 5';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();

	}
}
