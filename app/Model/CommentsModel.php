<?php
namespace Model;

class CommentsModel extends \W\Model\Model
{
  public function joinComment(){

    $sql = 'SELECT users.username, users.avatar, users.url, comments.content, comments.date_add FROM users INNER JOIN comments ON users.id = comments.id_user';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    return $sth->fetchAll();
  }
}
