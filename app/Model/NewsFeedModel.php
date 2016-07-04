<?php

namespace Model;

class NewsfeedModel extends \W\Model\Model
{
    public function joinNewsFeed($id){

      $sql = 'SELECT newsfeed.id_event, newsfeed.id_user, newsfeed.date_news, newsfeed.action,  newsfeed.list_name, newsfeed.card_name, users.username, users.avatar, users.id
      FROM newsfeed
      INNER JOIN users ON users.id = newsfeed.id_user
      WHERE newsfeed.id_event ='.$id;

      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
    }
}
