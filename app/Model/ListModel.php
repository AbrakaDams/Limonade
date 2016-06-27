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

        $sql = 'SELECT * FROM cards WHERE id_event='.$id.' AND date_add > "' .  $lastDate .'"';

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }


}
