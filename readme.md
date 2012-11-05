# Alys Google Maps Organiser
***

## Ajouter un nouveau client
En **2** étapes:

1. Création du client ( login & mot de passe )
2. Ajout d'une ligne de code pour l'url ( ndd/**nomDuClient** )

### 1. Ajout du client
L'ajout du client se fait via l'administration, à l'URL: `/client/listing`


* Le champ **Société**, sera le login du client. <br/>
*Important*: Bien utiliser le nom de société, ceci va être utiliser pour créer le layout du client (ajouter les bonnes classes CSS, header>h1, etc.) 
* Le **Password**, ne sera plus visible après donc bien retenir.


### 2. Ajout du code
Il suffit d'ouvrir le fichier `application/routes.php`

Ensuite ajoutez une nouvelle ligne de code sous la partie **"Routes pour clients"**

Copiez / coller ceci:

```
Route::any('utilisateur', array('as' => 'utilisateur', 'uses' => 'company@index', 'before' => 'client') );
```

Il suffit de changer 2 fois **'utilisateur'** par le login choissi à l'étape 1.
