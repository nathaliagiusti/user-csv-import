<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?= $cssFile ?>" />
</head>
<body>
<form action="/user" method="post" enctype="multipart/form-data">
<h2>Import users from CSV</h2>
    <input type="file" name="csv" accept=".csv" />
    <input type="submit" value="Import users" />
</form>
</body>
</html>
