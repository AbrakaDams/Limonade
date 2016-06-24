<?php
namespace Model;

class TokensRegisterModel extends \W\Model\Model
{
	public function findTokenRegister($email, $token)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return false;
		}

		$sql = 'SELECT * FROM ' . $this->table . ' WHERE email="' .$email.'" AND token="' .$token.'"';
		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetch();
	}
}