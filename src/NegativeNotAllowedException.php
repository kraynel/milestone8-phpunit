<?php
namespace Demo;

/**
* Définition d'une classe d'exception personnalisée
*/
class NegativeNotAllowedException extends \Exception
{

  // Redéfinissez l'exception ainsi le message n'est pas facultatif
  public function __construct($message, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }

}