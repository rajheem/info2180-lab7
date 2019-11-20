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
<?php if(!$_GET||$country===''):?>
<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
<?php else:
  filter_var($country, FILTER_SANITIZE_STRING);
  foreach ($results as $row):
    if ($row['name']===$country):?>
       <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
        <table>
            <caption>List of Countries</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Continent</th>
                    <th>Independence</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['continent']; ?></td>
                    <td><?= $row['independence_year']; ?></td>
                    <td><?= $row['head_of_state']; ?></td>
                </tr>
            </tbody>
        </table>
      <?php
    endif;
  endforeach;
endif;

?>