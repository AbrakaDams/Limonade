<?php
namespace Model;

class ListModel extends \W\Model\Model
{
	public function showLists($id) {

        $sql = 'SELECT * FROM ' . $this->table . 'WHERE id_event = ' . $id;
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }
}
