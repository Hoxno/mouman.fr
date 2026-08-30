# Mon Site Web Personnel

Bienvenue sur mon site web personnel ! C'est ici que je partage des informations sur moi, mes compétences, mon expérience professionnelle, mes formations et bien plus encore. Vous pouvez visiter mon site en ligne à [mouman.fr](https://mouman.fr).

## À propos

Ce site a pour but de me présenter, de partager mon parcours professionnel et éducatif, ainsi que de présenter mes compétences et expériences. Vous y trouverez également un moyen de me contacter.

## Fonctionnalités

- **Section À propos** : Découvrez qui je suis, mon titre professionnel et une brève description de moi-même.

- **Section Compétences** : Consultez mes compétences, y compris les compétences en programmation et autres.

- **Section Expériences** : Explorez mon expérience professionnelle, y compris les entreprises où j'ai travaillé et les descriptions de mes postes.

- **Section Formations** : Découvrez mes parcours académiques et les établissements où j'ai étudié.

- **Section Contact** : Vous souhaitez me contacter ? Utilisez le formulaire de contact pour m'envoyer un message.

- **Espace d'administration** : Un tableau de bord protégé permet de gérer compétences, expériences et formations, et de choisir lesquelles apparaissent sur le site public.

## Technologies Utilisées

Ce site web personnel a été développé en utilisant les technologies suivantes :

- [Laravel](https://laravel.com/) 13 — framework backend
- [Tailwind CSS](https://tailwindcss.com/) 3 — mise en forme
- [Alpine.js](https://alpinejs.dev/) — interactions légères
- [Vite](https://vitejs.dev/) 8 — compilation des assets
- [Pest](https://pestphp.com/) — tests
- MySQL — base de données

## Prérequis

- **PHP 8.3 ou supérieur** — exigé par Laravel 13
- **Composer**
- **Node.js 20.19+ ou 22.12+** — exigé par Vite 8
- **MySQL 8** ou MariaDB

## Comment Exécuter le Projet Localement

Si vous souhaitez exécuter ce projet localement, voici comment vous pouvez le faire :

1. Clonez ce dépôt :

        git clone https://github.com/Hoxno/mouman.fr.git

2. Accédez au répertoire du projet :

        cd mouman.fr

3. Installez les dépendances PHP :

        composer install

4. Installez les dépendances front-end et compilez les assets :

        npm install
        npm run build

   Cette étape est indispensable : le dossier `public/build` n'est pas versionné, et le site s'affiche sans aucun style tant qu'il n'a pas été généré.

5. Copiez le fichier `.env.example` pour créer un fichier `.env`, puis renseignez vos paramètres de connexion à la base de données :

        cp .env.example .env

6. Générez une clé d'application Laravel :

        php artisan key:generate

7. Créez la base de données déclarée dans votre `.env`, puis exécutez les migrations :

        php artisan migrate

8. Créez les liens symboliques vers le stockage, nécessaires à l'affichage de la photo de profil et au téléchargement du CV :

        php artisan storage:link

9. Lancez le serveur de développement :

        php artisan serve

10. Ouvrez votre navigateur et accédez à l'URL indiquée par Laravel pour visualiser le site localement.

Pour travailler sur les feuilles de style ou les scripts, lancez `npm run dev` dans un second terminal : Vite recompile alors les assets à chaque modification.

## Premier accès à l'administration

L'inscription n'est ouverte que tant qu'aucun compte n'existe : rendez-vous sur `/register` pour créer le vôtre, après quoi la route se ferme d'elle-même.

Le tableau de bord exige une adresse vérifiée. En développement, placez `MAIL_MAILER=log` dans votre `.env` : le lien de vérification sera écrit dans `storage/logs/laravel.log` plutôt qu'envoyé par courriel.

## Tests et qualité

    composer pest    # suite de tests
    composer stan    # analyse statique (PHPStan niveau 6)
    composer pint    # formatage du code
    composer clean   # les trois enchaînés

Les tests s'exécutent sur une base SQLite en mémoire : ils ne touchent pas à vos données.

## Contribuer

Si vous souhaitez contribuer à ce projet, n'hésitez pas à soumettre des pull requests ou à signaler des problèmes.

## Auteur

- [Hoxno](https://github.com/Hoxno)

N'hésitez pas à explorer le code source de ce projet pour en savoir plus !
