<?php 

$mode = "new";

$new = @$_POST['newNote'];
$edit = @$_POST['editBtn'];
$update = @$_POST['updateBtn'];
$delete = @$_POST['deleteBtn'];

$editNote = @$_POST['editNote'];

// Connection
$conn = new Mongo();
$notes = $conn->praglabs_mongo->notes;

// Get all the rows/collections
$getNotes = $notes->find();

// Create a note
  if ($new){
    $notes->insert(array('note' => $new ));    
  }
  

// Update a note
  if ($edit){
    $mode = "edit";
    $id = new MongoID($edit);
    $note = $notes->find(array('_id' => $id));
    foreach ($note as $noteToEdit) {}
  }

  if ($update){
    $id = new MongoID ($update);
    $notes->update(   array( '_id'=> $id ),     array( 'note' => $editNote )    );
  }

  
// Delete a note
  if ($delete){
    $id = new MongoID ($delete);
    $notes->remove(array( '_id' => $id));
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
      td {
        word-wrap: break-word;      
        max-width: 520px;
      }
    </style>
  </head>
  <body>

    <div class="container-fluid">
      <form method="POST" class="form">
      
        <div class="row-fluid">   
                  
                  <div class="span6 offset3">
                  <h1>Notes</h1>  
                  <br>
                    <?php if ($mode == "new"): ?>
                        <textarea class="span12" name="newNote" placeholder="Write a new note..."></textarea><br>
                        <input type="submit" class="btn btn-primary" value="Save"/>
                    <?php elseif ($mode == "edit"): ?>
                          <textarea class="span12" name="editNote"><?= $noteToEdit['note']; ?></textarea><br>
                          <button class="btn btn-success" name="updateBtn" value="<?= $edit ?>">Update</button>
                    <?php endif; ?>
                    <br><br>
            
                  </div>
         </div>
         
         <div class="row-fluid">
     
                  <div class="span6 offset3">
                    <table class="table table-hover span">
                    <?php    if (!$getNotes):  ?>
                          <tr>
                            <td>
                              You have not created any notes yet.
                            </td>
                          </tr>
                      <?php   else: 
                              foreach ($getNotes as $note):  ?>
                          <tr>
                            <td>
                                  <?= $note['note']; ?>
                            </td>
                            <td>
                                 <button class="btn btn-inverse" name="editBtn" value="<?= $note['_id'] ?>"><i class="icon-edit icon-white"></i></button>
                                 <button class="btn btn-danger" name="deleteBtn" value="<?= $note['_id'] ?>"><i class="icon-remove icon-white"></i></button>
                            </td>
                          </tr>
                          <?php endforeach; endif;    ?>
                     </table>      
                    
                    </div>
          </div>
        </form>
     </div>

  </body>
</html>