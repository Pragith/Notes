<?php require_once('config.php'); 

  $mode = "new";
  $q = mysql_query("SELECT * FROM notes");

  $new = @$_POST['newNote'];
  $edit = @$_POST['editBtn'];
  $update = @$_POST['updateBtn'];
  $delete = @$_POST['deleteBtn'];

  $editNote = @$_POST['editNote'];


// Create a note
  if ($new){
    mysql_query("INSERT INTO notes VALUES ('','$new')");
    header('Location: ./');
  }
  

// Update a note
  if ($edit){
    $mode = "edit";
    $noteToEdit = mysql_fetch_row(mysql_query("SELECT note FROM notes WHERE id = $edit"));
  }

  if ($update){
      mysql_query("UPDATE notes SET note = '$editNote' WHERE id = $update");
      header('Location: ./');
  }

  
// Delete a note
  if ($delete){
      mysql_query("DELETE FROM notes WHERE id = '$delete'");
      header('Location: ./');
  }



?>
<!DOCTYPE html>
<html>
  <head>
    <title>Notes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
      tr:nth-child(odd)    { background-color:#eee; }
      tr:nth-child(even)    { background-color:#fff; }
      table{
        padding-left: 150px;
        padding-right: 150px;
      }
      .form{
        margin-right: 150px;
        margin-left:150px;

      }
    </style>
  </head>
  <body>

    <form method="POST" class="form">
          <h1>Notes</h1>  
          <br>
            <?php if ($mode == "new"): ?>
                <textarea class="span12" name="newNote" placeholder="Write a new note..."></textarea><br>
                <input type="submit" class="btn btn-primary" value="Save"/>
            <?php elseif ($mode == "edit"): ?>
                  <textarea class="span12" name="editNote"><?= @$noteToEdit[0]; ?></textarea><br>
                  <button class="btn btn-success" name="updateBtn" value="<?= $edit ?>">Update</button>
            <?php endif; ?>

            <br><br>

          <?php     
          // Checking whether there are any notes present

            if (!$q): echo "You have not created any notes yet. Please click on 'New Note' to begin.";
            else: ?>

            <table class="table table-hover">
                <?php while ($note= @mysql_fetch_array($q)): ?>
               
                  <tr>
                    <td>
                          <?= $note['note']; ?>
                    </td>
                    <td>
                         <button class="btn btn-inverse" name="editBtn" value="<?= $note['id'] ?>"><i class="icon-edit icon-white"></i></button>
                         <button class="btn btn-danger" name="deleteBtn" value="<?= $note['id'] ?>"><i class="icon-remove icon-white"></i></button>
                    </td>
                  </tr>

                  <?php endwhile; endif;  ?>
          </table>  
    </form>

  </body>
</html>