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

  public function get_id()
  {
    return $this->id;
  }

  public function get_region()
  {
    return $this->region;
  }
  public function set_region($region)
  {
    $this->region = $region;
  }
  public function get_date()
  {
    return $this->date;
  }
  public function set_date($date)
  {
    $this->date = $date;
  }
  public function get_titre()
  {
    return $this->titre;
  }
  public function set_titre($titre)
  {
    $this->titre = $titre;
  }
  public function get_description()
  {
    return $this->description;
  }
  public function set_description($description)
  {
    $this->description = $description;
  }
}