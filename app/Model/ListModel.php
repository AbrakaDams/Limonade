<?php
namespace Model;

class ListModel extends \W\Model\Model
{
    /**
    * function to get all the lists of cards for a certain event that depends on id_event
    */
	public function findLists($id) {

        $sql = 'SELECT * FROM ' . $this->table . ' WHERE id_event=' . $id;
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }
}
