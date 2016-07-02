<?php
namespace Model;

class CardsModel extends \W\Model\Model
{
    public function findOneCard($id) {

        $sql = 'SELECT cards.id, cards.card_title, cards.id_list, cards.description, cards.quantity, cards.price, cards.id_user, cards.date_add, users.username, users.firstname, users.lastname
        FROM cards
        LEFT JOIN users ON cards.id_user = users.id
        WHERE cards.id='.$id;

		$sth = $this->dbh->prepare($sql);
		$sth->execute();

		return $sth->fetchAll();
    }
}
