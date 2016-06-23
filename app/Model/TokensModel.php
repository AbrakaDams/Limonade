<?php
namespace Model;

class TokensModel extends \W\Model\Model
{
	public function findToken($email, $token)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE email="' .$email.'" AND token="' .$token.'"';
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		//var_dump($sql);
		return $sth->fetch();
	}
}