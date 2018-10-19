<?php
include_once 'config.php';
$query = "select * from EmailsReports order by id desc LIMIT 50 ";
$result = $dbconn->query($query);
?>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>
<table class="table .table-striped">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Type</th>
            <th scope="col">Recipient</th>
            <th scope="col">Domain</th>
            <th scope="col">Headers</th>
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>
<?php
while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
            <th scope='row'>".$row['id']."</th>
            <td>".$row['Type']."</td>
            <td>".$row['Recipient']."</td>
            <td>".$row['Domain']."</td>
            <td>".$row['messageHeaders']."</td>
            <td>".$row['moreData']."</td>
        </tr>";
}
?>
	</tbody>
</table>
</body>
</html>