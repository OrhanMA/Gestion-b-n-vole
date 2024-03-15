<?php

require_once __DIR__ . '/UUID.php';
class Event
{
  public $id, $region, $date, $titre, $description;

  public function __construct($region, $date, $titre, $description)
  {
    $this->id = UUID::v4();
    $this->region = $region;
    $this->date = $date;
    $this->titre = $titre;
    $this->description = $description;
  }

  function get_array_from_event()
  {
    return ['id' => $this->id, 'region' => $this->region, 'date' => $this->date, 'titre' => $this->titre, 'description' => $this->description];
  }


  // J'ai supprimé les getters et setters pour cette classe car je n'en ai pas eu besoin. Ils sont quand-même visibles dans d'anciens commit
}
