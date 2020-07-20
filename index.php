<?php include_once 'header.php'; ?>

      <div class="container px-3 py-3">
        <p>
          <a href="add.php" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Ajouter un projet</a>
        </p>
        <?php
        $stmt = $db->query('SELECT id, titre, contenu FROM projets ORDER BY id DESC');
        while($row = $stmt->fetch()) {
          echo '<div class="card px-3 py-3 mb-3">';
            echo '<h4><a href="projet.php?id=' . $row['id'] . '">' . $row['titre'] . '</a></h4>';
            echo '<p class="text-justify">' . $row['contenu'] . '</p>';
            echo '<p class="text-right">';
              echo '<a href="edit.php?id=' . $row['id'] . '" class="btn btn-success btn-sm mr-2" tabindex="-1" role="button" aria-disabled="true">Editer</a>';
              echo '<a href="delete.php?delprojet=' . $row['id'] . '" class="btn btn-danger btn-sm" tabindex="-1" role="button" aria-disabled="true">Supprimer</a>';
              echo '</p>';
          echo '</div>';
        }
        ?>
      </div>

<?php include_once 'footer.php'; ?>
