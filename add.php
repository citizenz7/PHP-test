<?php include_once 'header.php'; ?>

    <div class="container px-3 py-3">
      <?php
      //if form has been submitted process it
      if(isset($_POST['submit'])){
        //collect form data
        extract($_POST);

        if($titre ==''){
          $error[] = 'Veuillez entrer un titre.';
        }

        if($contenu ==''){
          $error[] = 'Veuillez entrer un texte';
        }

        if(!isset($error)){
          try {
            $stmt = $db->prepare('INSERT INTO projets (titre, contenu) VALUES (:titre, :contenu)') ;
            $stmt->execute(array(
              ':titre' => $titre,
              ':contenu' => $contenu
            ));

            //redirect to index page
            header('Location: index.php');
            exit;
          }
          catch(PDOException $e) {
            echo $e->getMessage();
          }
        }
        if(isset($error)){
          foreach($error as $error){
            echo '<div style="color: red; font-weight: bold; text-align: center;">'.$error.'</div>';
          }
        }
      }
      ?>

      <h2>Ajouter un projet</h2>

      <form action="" method="POST">
         <div class="form-group">
           <label for="titre">Titre</label>
           <input type="text" name="titre" class="form-control" id="titre">
         </div>
         <div class="form-group">
           <label for="contenu">Contenu</label>
           <textarea name="contenu" class="form-control" id="contenu" rows="10"></textarea>
         </div>
          <div class="text-right">
            <button type='reset' class="btn btn-secondary">Annuler</button>
            <button type='submit' class="btn btn-primary" name='submit'>Ajouter</button>
          </div>
      </form>

    </div>

<?php include_once 'footer.php'; ?>
