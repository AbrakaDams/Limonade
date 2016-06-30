<?php

namespace Model;

class NewsFeedModel extends \W\Model\Model
{
  public function joinNewsFeed($id){

      $sql = 'SELECT newsfeed.id_event, newsfeed.id_user, newsfeed.action, newsfeed.id_card, list.title, list.id_event, list.date_add, users.username, users.avatar, users.id
      FROM newsfeed
      INNER JOIN list ON list.id = newsfeed.id_comment
      INNER JOIN users ON users.id = newsfeed.id_user
      INNER JOIN cards ON cards.id = newsfeed.id_card
      WHERE newsfeed.id_event ='.$id;

      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
    }
}
