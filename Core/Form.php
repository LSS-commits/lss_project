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
     * Valider si tous les champs proposés sont remplis
     * Cette méthode statique peut être utilisée sans instancier d'objet Form
     * @param array $form Tableau issu du formulaire ($_POST, $_GET)
     * @param array $fields Tableau listant les champs obligatoires
     * @return bool Retourne un booléen
     */
    public static function validateForm(array $form, array $fields)
    {
        // parcourir les champs ($fields)
        foreach ($fields as $field) {
            // si le champ est absent ou vide dans le formulaire
            if (!isset($form[$field]) || empty($form[$field])) {
                // sortir et retourner false
                return false;
            }
        }
        return true;
    }

    // TODO: ajouter méthodes pour valider username, email, password (inscription) et mot (jeu)

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