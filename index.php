<?php

/**
 * 1. Commencez par importer le script SQL disponible dans le dossier SQL.
 * 2. Connectez vous à la base de données blog.
 */

/**
 * 3. Sans utiliser les alias, effectuez une jointure de type INNER JOIN de manière à récupérer :
 *   - Les articles :
 *     * id
 *     * titre
 *     * contenu
 *     * le nom de la catégorie ( pas l'id, le nom en provenance de la table Categorie ).
 *
 * A l'aide d'une boucle, affichez chaque ligne du tableau de résultat.
 */

// TODO Votre code ici.

try {
    $server = 'localhost';
    $db = 'blog';
    $user = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //Requête sans alias
    $request = $pdo->prepare("
        SELECT article.id, article.title, article.content, categorie.name
        FROM article
        INNER JOIN categorie ON category_fk = categorie.id
    ");

    if ($request->execute()) { ?>
        <p>Sans les alias</p> <?php
        foreach ($request->fetchAll() as $value) {
            echo "L'id de l'article : " . $value['id'] . "<br>" .
                 "Le titre de l'article : " . $value['title'] . "<br>" .
                 "Le contenu de l'article : " . $value['content'] . "<br>" .
                 "Le nom de l'article : " . $value['name'] . "<br>";
        }
    }

/**
 * 4. Réalisez la même chose que le point 3 en utilisant un maximum d'alias.
 */

// TODO Votre code ici.

    $request = $pdo->prepare("
        SELECT ar.id, ar.title, ar.content, ca.name
        FROM article as ar
        INNER JOIN categorie as ca ON category_fk = ca.id
    ");

    if ($request->execute()) { ?>
        <p>Avec les alias</p> <?php
        foreach ($request->fetchAll() as $value) {
            echo "L'id de l'article : " . $value['id'] . "<br>" .
                "Le titre de l'article : " . $value['title'] . "<br>" .
                "Le contenu de l'article : " . $value['content'] . "<br>" .
                "Le nom de l'article : " . $value['name'] . "<br>";
        }
    }

/**
 * 5. Ajoutez un utilisateur dans la table utilisateur.
 *    Ajoutez des commentaires et liez un utilisateur au commentaire.
 *    Avec un LEFT JOIN, affichez tous les commentaires et liez le nom et le prénom de l'utilisateur ayant écris le comentaire.
 */

// TODO Votre code ici.

    $request = $pdo->prepare("
        SELECT commentaire.content, utilisateur.firstName, utilisateur.lastName
        FROM commentaire
        LEFT JOIN utilisateur ON user_fk = utilisateur.id
    ");

    if ($request->execute()) { ?>
        <p>Les commentaires écrit par les utilisateurs</p> <?php
        foreach ($request->fetchAll() as $value) {
            echo "Le commentaire : " . $value['content'] . "<br>" .
                 "Le firstname : " . $value['firstName'] . "<br>" .
                 "Le lastname : " . $value['lastName'] . "<br>";
        }
    }
}
catch (Exception $exception) {
    echo $exception->getMessage();
}