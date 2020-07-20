<!-- Delete in SQL -->
<?php
include_once 'sql.php';

if(isset($_GET['delprojet'])) {
  $stmt = $db->prepare('DELETE FROM projets WHERE id = :id') ;
  $stmt->execute(array(':id' => $_GET['delprojet']));

  header('Location: index.php');
  exit;
}
else {
  header('Location: index.php');
  exit;
}
?>
