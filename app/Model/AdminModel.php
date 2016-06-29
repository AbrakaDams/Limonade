<?php
namespace Model;

class AdminModel extends \W\Model\Model
{
	public function findEvent($id)
	{
		if (!is_numeric($id)){
			return false;
		}

		$sql = 'SELECT * FROM event WHERE ' . $this->primaryKey .'  = :id LIMIT 1';
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(':id', $id);
		$sth->execute();

		return $sth->fetch();
	}
}