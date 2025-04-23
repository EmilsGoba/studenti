<?php require "views/components/header.php";?>

<h1>pievienot skolnieku</h1>
<?php foreach($errors as $error){ ?>
    <p><?= $error ?></p>
    <?php }?>
<form  action="/create" method="POST">
<label>First name: </label> <input name="first_name" type="text"> <br>
<label>Last name: </label> <input name="last_name" type="text"> <br>
<label>Subject: </label> <input name="subject" type="text"> <br>
<label>Grade: </label> <input name="grade" type="number"> <br>

<button>Submit</button>
</form>

<?php require "views/components/footer.php";?>