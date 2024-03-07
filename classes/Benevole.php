<?php

require_once __DIR__ . '/UUID.php';

class Benevole
{
  public $id, $first_name, $last_name, $age, $genre, $phone, $email, $region, $dispo_jour, $dispo_horaire, $poste, $message, $date_inscription, $missions;

  public function __construct($first_name, $last_name, $age, $genre, $phone, $email, $region, $dispo_jour, $dispo_horaire, $poste, $message)
  {
    $this->id = UUID::v4();
    $this->date_inscription = date("d-m-Y");
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->age = $age;
    $this->genre = $genre;
    $this->phone = $phone;
    $this->email = $email;
    $this->region = $region;
    $this->dispo_jour = $dispo_jour;
    $this->dispo_horaire = $dispo_horaire;
    $this->poste = $poste;
    $this->message = $message;
    $this->missions = [];
  }

  public function get_missions()
  {
    return $this->missions;
  }

  public function set_missions($missions)
  {
    $this->missions = $missions;
  }

  public function get_date_inscription()
  {
    return $this->date_inscription;
  }

  public function get_id()
  {
    return $this->id;
  }

  // public function set_id($id)
  // {
  //   $this->id = $id;
  // }
  public function get_first_name()
  {
    return $this->first_name;
  }

  public function set_first_name($first_name)
  {
    $this->first_name = $first_name;
  }
  public function get_last_name()
  {
    return $this->last_name;
  }

  public function set_last_name($last_name)
  {
    $this->last_name = $last_name;
  }
  public function get_age()
  {
    return $this->age;
  }

  public function set_age($age)
  {
    $this->age = $age;
  }
  public function get_genre()
  {
    return $this->genre;
  }

  public function set_genre($genre)
  {
    $this->genre = $genre;
  }
  public function get_phone()
  {
    return $this->phone;
  }

  public function set_phone($phone)
  {
    $this->phone = $phone;
  }
  public function get_email()
  {
    return $this->email;
  }

  public function set_email($email)
  {
    $this->email = $email;
  }
  public function get_region()
  {
    return $this->region;
  }

  public function set_region($region)
  {
    $this->region = $region;
  }
  public function get_dispo_jour()
  {
    return $this->dispo_jour;
  }

  public function set_dispo_jour($dispo_jour)
  {
    $this->dispo_jour = $dispo_jour;
  }
  public function get_dispo_horaire()
  {
    return $this->dispo_horaire;
  }

  public function set_dispo_horaire($dispo_horaire)
  {
    $this->dispo_horaire = $dispo_horaire;
  }
  public function get_poste()
  {
    return $this->poste;
  }

  public function set_poste($poste)
  {
    $this->poste = $poste;
  }
  public function get_message()
  {
    return $this->message;
  }

  public function set_message($message)
  {
    $this->message = $message;
  }
}