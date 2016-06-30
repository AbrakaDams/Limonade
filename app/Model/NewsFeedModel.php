<?php

namespace Model;

class NewsfeedModel extends \W\Model\Model
{
    public function joinNewsFeed($id){

      $sql = 'SELECT newsfeed.id_event, newsfeed.id_user, newsfeed.date_news, newsfeed.action, newsfeed.id_card, list.list_title, cards.card_title, list.id_event, list.date_add, users.username, users.avatar, users.id
      FROM newsfeed
      LEFT JOIN list ON list.id = newsfeed.id_list
      LEFT JOIN cards ON cards.id = newsfeed.id_card
      LEFT JOIN users ON users.id = newsfeed.id_user
      WHERE newsfeed.id_event ='.$id;

      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
    }
}
