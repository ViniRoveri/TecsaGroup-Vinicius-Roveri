<?php
$connect = mysqli_connect(
   'db',
   'viniroveri',
   '123456',
   'database'
);

$table_name = "tarefas";

$query = "SELECT * FROM $table_name";

$response = mysqli_query($connect, $query);
?>

<strong>Tarefas: </strong>

<?php
while($i = mysqli_fetch_assoc($response))
{
   echo "<p>".$i['title']."</p>";
   echo "<p>".$i['description']."</p>";
   echo "<p>".$i['created_at']."</p>";
   echo "<hr>";
}
?>
