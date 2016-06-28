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

    // public function findListsCards($id, $lastDate) {
    //
    //     // $sql = 'SELECT *
    //     //         FROM list
    //     //         INNER JOIN cards ON cards.id_list = list.id
    //     //         WHERE list.id_event='.$id.' AND list.date_add > "' .  $lastDate .'"';
    //
    //     $sql = 'SELECT list.id, list.title, cards.id, cards.id_list, cards.title, cards.description, cards.price, cards.date_add
    //             FROM list
    //             INNER JOIN cards ON list.id = cards.id_list
    //             WHERE list.id_event='.$id;
    //
	// 	$sth = $this->dbh->prepare($sql);
	// 	$sth->execute();
    //
	// 	return $sth->fetchAll();
    // }


}
