<?php
namespace FormBuilder;
 
use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
 
class UserFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Nom d\'utilisateur',
        'name' => 'username',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le nom d\'utilisateur spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier un nom d\'utilisateur'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Mot de passe',
        'name' => 'password',
        'validators' => [
          new NotNullValidator('Merci de rentrer un mot de passe'),
        ],
       ]));
  }
}