<?php include_once 'header.php'; ?>

    <div class="container px-3 py-3">

      <?php
      	if(isset($_POST['submit'])){
          //collect form data
          extract($_POST);

          //very basic validation
      		if($id ==''){
      			$error[] = 'Cet article n\'a pas de ID valide !';
      		}

      		if($titre ==''){
      			$error[] = 'Veuillez entrer un titre';
      		}

      		if($contenu ==''){
      			$error[] = 'Veuillez entrer le contenu du projet';
      		}

          if(!isset($error)) {

      			try {
              //insert into database
      				$stmt = $db->prepare('UPDATE projets SET titre = :titre, contenu = :contenu WHERE id = :id');
      				$stmt->execute(array(
      					':titre' => $titre,
      					':contenu' => $contenu,
                ':id' => $id
      				));

              //redirect to index page
      				header('Location: index.php');
      				exit;
      			}

            catch(PDOException $e) {
      			    echo $e->getMessage();
      			}

          }

        }

        if(isset($error)){
          foreach($error as $error){
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
          }
        }


        try {
    			$stmt = $db->prepare('SELECT id, titre, contenu FROM projets WHERE id = :id') ;
    			$stmt->execute(array(':id' => $_GET['id']));
    			$row = $stmt->fetch();
    		}

        catch(PDOException $e) {
    		   echo $e->getMessage();
    		}
      ?>

      <div class="pt-3"><h3>Editer le projet : "<?php echo $row['titre']; ?>"</h3></div>

      <form action="" method="POST">
        <input type='hidden' name='id' value='<?php echo $row['id'];?>'>
         <div class="form-group">
           <label for="titre">Titre</label>
           <input type="text" name="titre" class="form-control" id="titre" value="<?php echo $row['titre']; ?>">
         </div>
         <div class="form-group">
           <label for="contenu">Contenu</label>
           <textarea name="contenu" class="form-control" id="contenu" rows="10"><?php echo $row['contenu']; ?></textarea>
         </div>

          <div class="text-right pt-5">
            <button type='reset' class="btn btn-secondary">Annuler</button>
            <button type='submit' class="btn btn-primary" name='submit'>Editer le projet</button>
          </div>
      </form>

    </div>

<?php include_once 'footer.php'; ?>
