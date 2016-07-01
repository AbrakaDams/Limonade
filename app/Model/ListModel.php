<?php
namespace Model;

class ListModel extends \W\Model\Model
{
    /**
    * function to get all the lists of cards for a certain event that depends on id_event
    */
    public function findLists($id, $lastDate) {

        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id_event='.$id.' AND date_add > "' .  $lastDate .'"';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }

    public function findCards($id, $lastDate) {

        $sql = 'SELECT cards.id, cards.card_title, cards.id_list, cards.description, cards.quantity, cards.price, cards.id_user, cards.date_add, users.username, users.firstname, users.lastname
        FROM cards
        LEFT JOIN users ON cards.id_user = users.id
        WHERE cards.id_event='.$id.' AND cards.date_add > "' .  $lastDate .'"';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }

    public function deleteCard($id)
	{
		if (!is_numeric($id)){
			return false;
		}

		$sql = 'DELETE FROM cards WHERE ' . $this->primaryKey .' = :id LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		return $sth->execute();
	}

    public function getOneCard($id) {
        if (!is_numeric($id)){
			return false;
		}

		$sql = 'SELECT * FROM cards WHERE ' . $this->primaryKey .'  = :id LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
    }

    public function updateOneCard(array $data, $id, $stripTags = true)
	{
		if (!is_numeric($id)){
			return false;
		}

		$sql = 'UPDATE cards SET ';
		foreach($data as $key => $value){
			$sql .= "$key = :$key, ";
		}
		// Supprime les caractères superflus en fin de requète
		$sql = substr($sql, 0, -2);
		$sql .= ' WHERE ' . $this->primaryKey .' = :id';

		$sth = $this->dbh->prepare($sql);
		foreach($data as $key => $value){
			$value = ($stripTags) ? strip_tags($value) : $value;
			$sth->bindValue(':'.$key, $value);
		}
		$sth->bindValue(':id', $id);

		if(!$sth->execute()){
			return false;
		}
		return $this->find($id);
	}
}
