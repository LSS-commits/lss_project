<?php 
namespace LSSProject\Core;

class Form 
{
    private $formCode = '';

    /**
     * Générer le formulaire HTML et le retourner au controller qui le demande
     *
     * @return string
     */
    public function create()
    {
        return $this->formCode;
    }

    /**
     * Valider si tous les champs proposés sont remplis
     * cette méthode statique peut être utilisée sans instancier d'objet Form
     * @param array $form Tableau issu du formulaire ($_POST, $_GET)
     * @param array $fields Tableau listant les champs obligatoires
     * @return bool 
     */
    public static function validate(array $form, array $fields)
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

    
}