<?php
namespace Model;

class CommentsModel extends \W\Model\Model
{
  public function joinComment($id){

    $sql = 'SELECT users.username, users.avatar, users.url, comments.content, comments.date_add, comments.id_event FROM users
    INNER JOIN comments ON users.id = comments.id_user
    INNER JOIN event ON event.id = comments.id_event WHERE event.id = '.$id;

    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    return $sth->fetchAll();
  }
}
