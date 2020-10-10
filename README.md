# Kraken

Test technique fait par un ami pour une alternance, voici l'énoncé :

# 200 pts

6D6 = 6 dice with 6 faces
2D3 = 2 dices with 3 face
PV = Point de vie / Health Point
FOR = FORCE / STRENGTH
DEX = DEXTERITE / DEXTERITY
CON = CONSTITUTION / STAMINA

# FR

Création complète d'une API pour le Kraken
- faire un endpoint unique permettant l'ajout et la suppression d'une tentacule au kraken
(endpoint unique = même URL). Contrainte: 0 tentacule min / 8 tentacules max. Chaque
tentacule a un nom, 6D6 PV, FOR / DEX / CON à 10+2D3
- faire un endpoint de création de kraken avec comme argument: nom + age + taille en mètre +
poids en tonne.
- faire un endpoint pour ajouter un pouvoir au kraken. Contrainte: 1 pouvoir par défaut, 1 pouvoir
tous les 4 tentacules. Chaque pouvoir a un nom dans liste finie et est unique, max utilisation
pouvoir 2D4
- faire un endpoint pour faire un résumé de tous les éléments constituant le kraken, de manière
structuré sous forme de collection de paire "nom : valeur" (par exemple, les tentacules et les
pouvoirs doivent être chacun dans une collection listant les différents items)
Liste des pouvoirs:
- blast
- plague
- mind control
- ink fog
- force shield
- regeneration

# EN
Complete creation of an API for the Kraken
- make a single endpoint for the addition and removal of a kraken tentacle (single endpoint =
same URL). Constraint: 0 tentacle min / 8 tentacles max. Each tentacle has a name, 6D6 PV, FOR
/ DEX / CON at 10 + 2D3
- make a kraken creation endpoint with the following argument: name + age + size in meter +
weight in ton.
- make an endpoint to add power to the kraken. Constraint: 1 default power, 1 power all 4
tentacles. Each power has a name in finite list and is unique, max power usage 2D4
- make an endpoint to summarize all the elements constituting the kraken, in a structured way as
a collection of "name: value" pair (for example, tentacles and powers must each be in a collection
listing the different items)
List of powers:
- blast
- Plague
- mind control
- ink fog
- force shield
- regeneration


# 300 pts

# FR
Interface graphique création de kraken basée sur Kraken API.
L'interface doit être en deux colonnes.
Colonne A:
- lister les endpoints dans l'ordre suivant:
-- Création du kraken
-- Ajout de tentacule
-- Suppression de tentacule
-- Ajout de pouvoir
- les endpoints ne doivent être actifs que si cela est requis en suivant les restrictions de l'API (par
exemple, l'ajout de pouvoir seulement toutes les 4 tentacules)
Colonne B:
- lister les informations du kraken
- mettre à jour en fonction des différents ajouts/suppression faits par les endpoints

# EN
Kraken graphical interface based on Kraken API.
The interface must be in two columns.
Column A:
- list the endpoints in the following order:
- Creation of the kraken
- Adding tentacle
- Suppression of tentacle
- Addition of power
- endpoints should only be active if required by following API restrictions (for example, adding
power only to all 4 tentacles)
Column B:
- list the information of the kraken
- update according to the different additions / deletions made by the endpoints