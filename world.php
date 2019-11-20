<?php
$host = getenv('IP');
$username = 'lab7_user';
$password = 'my_password';
$dbname = 'world';
$country=$_GET['country'];
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php if(!$_GET):?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
<?php else:
  filter_var($country, FILTER_SANITIZE_STRING);
  foreach ($results as $row):
    if ($row['name']===$country):?>
      <h3><?= $row['name'];?></h3>
      <h3><?= $row['head_of_state'];?></h3>
      <?php
    endif;
  endforeach;
endif;
?>