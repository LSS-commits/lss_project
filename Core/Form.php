<?php 
namespace LSSProject\Core;

/**
 * Générateur de formulaires HTML (FormBuilder)
 */
class Form 
{
    private $formCode = '';

    /**
     * Générer le formulaire HTML et le retourner au controller qui le demande
     * Getter de la propriété formCode
     * 
     * @return string Retourne une chaîne de caractères
     */
    public function createForm()
    {
        return $this->formCode;
    }

    /**
     * Méthode pour tester les inputs (échapper HTML, retirer espaces inutiles et backslash)
     * lors de la validation du formulaire
     * @param $data Champ à tester
     */
    public static function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }


    /**
     * Valider si tous les champs proposés sont remplis
     * Cette méthode statique peut être utilisée sans instancier d'objet Form
     * @param array $form Tableau issu du formulaire ($_POST, $_GET)
     * @param array $fields Tableau listant les champs obligatoires
     * @return bool Retourne un booléen
     */
    public static function validateForm(array $form, array $fields)
    {
        // pour tester les entrées et initialiser des messages d'erreur
        $username = $email = $password = "";
        $usernameErr = $emailErr = $passwordErr = "";
        $errors = [];

        // parcourir les champs ($fields)
        foreach ($fields as $field) {
            // si le champ est absent ou vide dans le formulaire
            if (!isset($form[$field]) || empty($form[$field])) {
                // sortir et retourner false
                return false;
            }

            
            // valider username
            if ($field === "username") {
                $username = self::testInput($form[$field]);
                // username = seulement lettres et chiffres ou erreur 
                if (!preg_match("/^[a-zA-Z-0-9]*$/", $username)) {
                    $usernameErr = "Invalid username, only letters and numbers allowed";
                    $errors[] = $usernameErr;
                }
                // 12 caractères max
                if (strlen($username) > 12) {
                    $usernameErr = "Username must be 12 characters max";
                    $errors[] = $usernameErr;
                }
            }

            // valider email
            if ($field === "email") {
                $email = self::testInput($form[$field]);
                // email valide ? (longueur max de l'email => local (avant @) = 64, domaine (ex.com) = 255, totalité = 254)
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                    $errors[] = $emailErr;
                }
            }

            // valider password
            if ($field === "password") {
                $password = self::testInput($form[$field]);
                // au moins = 1 chiffre, 1 lettre min, 1 lettre maj, 1 symbole spécifié
                // seulement lettres, chiffres et symboles spécifiés
                // longueur mot de passe = entre 8 et 50
                if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#\-_$%&+=§!\?])[0-9a-zA-Z@#\-_$%&+=§!\?]{8,50}$/", $password)) {
                    $passwordErr = "Invalid password. Must be between 8 and 50 characters, and contain at least 1 number, 1 lowercase letter, 1 uppercase letter and 1 of the following symbols: @ # - _ $ % & + = § ! ?";
                    $errors[] = $passwordErr;
                }
            }

        }

        if ($errors) {
            // afficher les erreurs et retourner false
            foreach ($errors as $error) {
                echo '<p class="text-danger">' . $error . '</p>';
            }
            return false;
        }else{
            // retourner true si le formulaire est valide
            return true;
        }
    }

    // TODO: ajouter méthode pour valider mot (jeu)

    /**
     * Ajouter les attributs envoyés à la balise HTML
     *
     * @param array $attributes Tableau associatif ['attr' => 'valeur', 'required' => true]
     * @return string Retourne la chaîne de caractères générée
     */
    private function addAttributes(array $attributes): string
    {
        // initialiser une string
        $str = '';

        // lister les attributs dits "courts" (ne nécessitent pas de valeur)
        $shortAttrs = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        // boucler sur le tableau d'attributs
        foreach ($attributes as $attribute => $value) {
            // vérifier si l'attribut est dans la liste des attrs "courts" et que sa valeur est à true
            // (attr court avec une valeur false = pas d'attribut)
            if (in_array($attribute, $shortAttrs) && $value == true) {
                // concaténer les attributs avec des espaces entre eux
                $str .= " $attribute";
            }else{
                // ajouter attribut='valeur'
                $str .= " $attribute='$value'";
            }
        }

        return $str;
    }

    /**
     * Générer la balise d'ouverture d'un formulaire
     *
     * @param string $action Action du formulaire, par défaut # (où sont envoyées les données du formulaire ? Par défaut = le même fichier)
     * @param string $method Méthode du formulaire (post ou get, post par défaut)
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function startForm(string $action = '#', string $method = 'post', array $attributes = []): self
    {

        // créer la balise form
        $this->formCode .= "<form action='$action' method='$method'";

        // ajouter les attributs éventuels
        // si on a des attrs, les ajouter à formCode grâce à la méthode addAtributes et fermer la balise, sinon fermer la balise
        $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

        return $this;
    }

    /**
     * Générer la balise de fermeture d'un formulaire
     *
     * @return Form Retourne l'objet
     */
    public function endForm(): self
    {
        $this->formCode .= '</form>';
        return $this;
    }

    /**
     * Générer une balise label avec un attribut for
     *
     * @param string $for Egal à l'id de l'input correspondant
     * @param string $text Texte du label
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addLabelFor(string $for, string $text, array $attributes = []): self
    {
        // ouvrir la balise
        $this->formCode .= "<label for='$for'";

        // ajouter les éventuels attributs 
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

        // ajouter le texte et fermer la balise
        $this->formCode .= ">$text</label>";

        return $this;
    }

    /**
     * Générer une balise input
     *
     * @param string $type Type de l'input
     * @param string $name Attribut name de la balise (référence de la balise pour le traitement du formulaire)
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addInput(string $type, string $name, array $attributes = []): self
    {
        $this->formCode .= "<input type='$type' name='$name'";
        // NB: ne pas oublier l'id en attribut si l'input est associé à un label
        $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

        return $this;
    }

    /**
     * Générer une balise textarea avec un attribut name et un contenu vide par défaut
     *
     * @param string $name Attribut name de la balise (référence de la balise pour le traitement du formulaire)
     * @param string $text Contenu du champ (vide par défaut ici)
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addTextarea(string $name, string $text = '', array $attributes = []): self
    {
        
        $this->formCode .= "<textarea name='$name'";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        $this->formCode .= ">$text</textarea>";
        
        return $this;
    }

    /**
     * Générer une balise select avec un attribut name et les balises options
     *
     * @param string $name Attribut name de la balise (référence de la balise pour le traitement du formulaire)
     * @param array $options Tableau avec les différentes options (tableau associatif)
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addSelect(string $name, array $options, array $attributes = []): self
    {
        // ouvrir le select
        $this->formCode .= "<select name='$name'";

        // ajouter les attributs
        $this->formCode .= $attributes ? $this->addAttributes($attributes) . '>' : '>';

        // ajouter chacune des options avec sa valeur (envoyée au serveur), le texte affiché et un éventuel attribut pour l'option
        foreach($options as $value => [$text, $attr]){
            $attr = $attr ? $this->addAttributes($attr) : '';
            $this->formCode .= "<option value='$value'$attr>$text</option>";
        }

        // fermer le select
        $this->formCode .= "</select>";

        return $this;
    }

    /**
     * Générer une balise button
     * (NB ne pas oublier le type dans les attributs)
     * @param string $text Contenu du bouton
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addButton(string $text, array $attributes = []): self
    {
        $this->formCode .= "<button ";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';
        $this->formCode .= ">$text</button>";

        return $this;
    }

    /**
     * Générer une balise ouvrante en précisant son nom et ses attributs éventuels
     *
     * @param string $tag Nom de la balise
     * @param string $text Eventuel contenu (vide par défaut) 
     * @param array $attributes Attributs complémentaires (tableau vide par défaut)
     * @return Form Retourne l'objet
     */
    public function addTagStart(string $tag, string $text = '', array $attributes = []): self
    {
        $this->formCode .= "<$tag ";
        $this->formCode .= $attributes ? $this->addAttributes($attributes) . ">$text" : ">$text";
        return $this;
    }

    /**
     * Générer une balise fermante 
     *
     * @param string $tag Nom de la balise
     * @param string $text Eventuel contenu (vide par défaut) 
     * @return Form Retourne l'objet
     */
    public function addTagEnd(string $tag, string $text = ''): self
    {
        $this->formCode .= "$text</$tag>";

        return $this;
    }
}