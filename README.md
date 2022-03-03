# e-shoes

L’objectif de l’exercice est de réaliser une ébauche de site ecommerce en PHP/Symfony présentant
quelques fonctionnalités clés. Nous allons vendre des T-shirts et des chaussures. L’idée est
d’implémenter le projet selon les specs fonctionnelles et techniques décrites ci-dessous. Utilise tes
connaissances et les docs pour coder le projet selon les bonnes pratiques PHP/Symfony. A toi
également de construire la base de données selon la logique qui te semble la bonne.
La web app possèdera une partie Backoffice accessible uniquement aux personnes ayant créé un
compte et une partie Frontoffice accessible à tout visiteur. Voici les specs fonctionnelles :
Le back office devra :
- Permettre de créer des produits possédant une Catégorie Chaussures ou T-shirt avec des
Tailles dans un unique formulaire dynamique : si l’utilisateur sélectionne Chaussures, elles
pourront avoir des pointures sélectionnables du 38 au 46 et les Tshirts des tailles de XS à XL.
Des mots clés seront renseignés pour chaque produit afin de faciliter la recherche par les
clients
- Il devra présenter une API créé avec API Platform permettant de connaitre le catalogue
produit par une requete GET. On pourra la tester avec Postman ou Insomnia
Le front office devra :
- Permettre de consulter le catalogue.
- De sélectionner les catégories pour n’afficher que les produits de la catégorie en question. Le
cas échéant les tailles correspondant à la catégorie seront proposées, permettant à
l’utilisateur d’affiner sa recherche que sur les produits dispos dans sa taille.
- De faire une recherche sur le catalogue affichant dans l’ordre, les produits dont le nom de la
catégorie correspond au terme de la recherche puis les produits dont l’un des mots clés
correspond au terme de la recherche
