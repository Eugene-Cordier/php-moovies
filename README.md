# ROLIN ENZO <code>roli0007</code>  

# CORDIER EUGENE <code>cord0048</code>

# I Configuration du projet

### Configuration du dépot git

le dépôt git contient une branche main protégée.  
Eugène utilise une autre branche pour commit sur le dépôt.  
Enzo utilise également une 3ème branche pour commit.  
Des demandes de merge avec la branche main sont faites par chacun et vérifiée par l'autre.
### Configuration du dossier de projet

- Nous avons configurer notre dossier avec composer et php-cs-fixer.  
  Il y a donc le dossier Vendor, les fichiers composer.lock, composer.json et php-cs-fixer.
- le composer.json permet l'utilisation de php-cs-fixer et de PDO.  
  Il contient également les informations du projet ainsi que les scripts permettant le lancement sous window et sous Linux
- Nous avons également utilisé MyPdo, pour gérer les données provenant de la base de données.
  Nous avons configuré le .mypdo.ini pour se connecter à la base donnée.
- Nous avons ajouté un .gitignore contenant les fichiers sensibles comme
  .mypdo.ini qui contient les identifiants pour accéder à la base de données.

### Organisation du dossier de projet

- La racine du projet contient les dossiers bin, public, src et les fichiers/dossiers de configuration (Vendor, composer.json, composer.lock, .gitignore, .mypdo.ini, .php-cs-fixer.php et .cache)
- Le dossier bin contient les scripts de lancement sous Windows (run-server.bat) et Linux (run-server.sh)
- Le dossier public contient toutes les pages HTML, leur css ainsi que les images et le dossier admin.
- Le dossier admin contient les pages HTML relative au fonctionnalités de création, mise à jour et suppression de films.
- Le dossier source contient toutes les classes utilisées pour ce projet et est divisé en 4 sous-parties.
- Le dossier Database contient la classe Mypdo.  
  Le dossier Entity contient les classes servant à la récupération des données.  
  Le dossier Exception contient les classes permettant de gérer les exceptions et erreurs.  
  Le dossier HTML contient les classes permettant de donner forme aux pages HTML.

### scripts

- start:linux (démarre le serveur sous linux)
- start:win (démarre le serveur sous window)
- fix:cs (fixe le code)
# II Fonctionnalités

### Description

Le site est relié à une base de données et permet l'accès à une liste de films et d'acteurs.  
Le site permet d'effectué des recherches de films filtrées par genre.  
Le site permet également de connaitre tout les acteurs d'un film, des informations détaillées sur ce dernier.  
Le site permet également de connaître tout les film d'un acteur.  
le site permet aussi de rajouter, supprimer ou modifier les informations d'un film.

### fonctionnement
- l'accès à la liste des films se fait dans la page index.php,
  cette dernière contient un menu sous forme de formulaire permettant la recherche filtrée.
  Les informations du formulaire sont récupérer à l'aide d'un $_GET[" "] et
  une redirection est faite vers index.php pour actualiser
  la page avec les données du formulaire.  
  Après cela, un if permet de faire une requête SQL en
  fonction du filtre, s'il n'y a pas de filtres, la requête prend touts les films de la base de données.  
  un formulaire permet une redirection vers movie-form.php pour la création d'un nouveau film.
  En cliquant sur un film, une redirection est effectué vers movie.php.
- Sur movie.php,on peut accéder au film, à ces informations ainsi qu'à la liste des acteurs jouant dans le film.  
  Un menu pour la mise à jour et la suppression d'un film est mis en place à travers des redirections.  
  Une redirection vers actor.php est effectué à l'aide d'un lien si l'on clique sur l'image d'un acteur.
  Un dernier formulaire contenant un boutton submitt est mis en place pour une redirection sur index.php
- Sur Actor.php, Une requête SQL est effectué à l'aide des données d'un formulaire
  permettant d'avoir les informations de l'acteur.  
  Une autre requête est effectuée permettant avec un foreach d'afficher tout les films de cet acteur.  
  Une redirection avec un lien est mise en place sur l'image des films.
- Sur movie-delete.php, la suppression d'un film est effectué après les tests de vérification de conformité de la donnée envoyée.
- Sur movie-form.php, la création d'un film est faite après les mêmes tests que sur movie-delete.php et un choix est effectué à l'aide d'un if.
- Sur movie-save.php, la modification des informations d'un film est effectuée.  
  une vérification sur l'existence des données est effectué à l'aide d'une requête SQL.
