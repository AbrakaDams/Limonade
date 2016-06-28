<?php
namespace Model;

class CommentsModel extends \W\Model\Model
{
  public function joinComment($id){

    $sql = 'SELECT users.username, users.avatar, users.url, comments.content, comments.date_add
    FROM users
    INNER JOIN comments ON users.id = comments.id_user
    WHERE comments.id_event='.$id.' ORDER BY comments.date_add DESC ';

    $sth = $this->dbh->prepare($sql);
    $sth->execute();

    return $sth->fetchAll();
  }
  public function findAllComments($orderBy = '', $orderDir = 'ASC', $limit = null, $offset = null, $id = null)
  {

      $sql = 'SELECT * FROM ' . $this->table;
      if (!empty($orderBy)){

          //sécurisation des paramètres, pour éviter les injections SQL
          if(!preg_match('#^[a-zA-Z0-9_$]+$#', $orderBy)){
              die('Error: invalid orderBy param');
          }
          $orderDir = strtoupper($orderDir);
          if($orderDir != 'ASC' && $orderDir != 'DESC'){
              die('Error: invalid orderDir param');
          }
          if ($limit && !is_int($limit)){
              die('Error: invalid limit param');
          }
          if ($offset && !is_int($offset)){
              die('Error: invalid offset param');
          }
          if ($id && !is_int($id)){
              die('Error: invalid id param');
          }

          $sql .= ' ORDER BY '.$orderBy.' '.$orderDir;
          if($limit){
              $sql .= ' LIMIT '.$limit;
              if($offset){
                  $sql .= ' OFFSET '.$offset;
              }
          }
          if($id){
              $sql .= ' WHERE id_event='.$id;
          }
      }
      $sth = $this->dbh->prepare($sql);
      $sth->execute();

      return $sth->fetchAll();
  }
}
