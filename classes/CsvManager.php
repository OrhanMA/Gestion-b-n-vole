<?php

class CsvManager
{
  public $pathToCsv;
  function __construct($pathToCsv)
  {
    $this->pathToCsv = $pathToCsv;
  }

  function getBenevoleByID($id, $csvPath)
  {
    $csv = new CsvManager($csvPath);
    $file = $csv->openCsv();
    $csv->readCsv();
    $benevoles = $csv->readFromCsv();


    foreach ($benevoles as $benevole) {
      // ajouter la bénévole dans la variable $user_found si son ID correspond au code soumis
      $benevole_id = $benevole[0];
      if ($benevole_id == $id) {
        $user_found = $benevole;
        $csv->closeCsv($file);
        return $user_found;
      }
    }
    $csv->closeCsv($file);
    return null;
  }

  function readCsv()
  {
    return fopen($this->pathToCsv, 'r');
    // le mode 'r' ouvre en lecture seule et place le pointeur de fichier au début du fichier.
  }
  function openCsv()
  {
    return fopen($this->pathToCsv, 'ab');
  }
  function writeIntoCsv($file, $arrayToWrite)
  {
    fputcsv($file, $arrayToWrite);
  }
  function closeCsv($file)
  {
    fclose($file);
  }

  // function findBenevole($code) 
  // {
  //   $data = [];
  //   $csv = $this->readCsv();
  //   if(!$csv == false) {
  //     while (($row = fgetcsv($csv)) !== false) {

  //     }
  //   }
  // }

  public function readFromCsv()
  {
    $data = [];
    // instancie un array vide
    $csv = $this->readCsv();
    // ouvre le fichier csv à l'aide du chemin

    if ($csv !== false) {
      // readCsv return un boolean pour ouvert/fermé. 
      // Si ouvert
      while (($row = fgetcsv($csv)) !== false) {
        // fgetcsv retourne la ligne d'un fichier et le parse en format csv
        // Tant qu'il y a encore une ligne dans le fichier ajoute le ligne dans le tableau data
        $data[] = $row;
      }

      $this->closeCsv($csv);
      // ferme le csv
    }

    return $data;
    // retourne la data
  }
  function get_path(): string
  {
    return $this->pathToCsv;
  }
  function set_path($path)
  {
    $this->pathToCsv = $path;
  }

  public function update_benevole_missions($id, $new_mission, $csv_path)
  {
    $csv = new CsvManager($csv_path);
    $file = $csv->readCsv();
    $temporary_file = fopen('php://temp', 'r+');

    while ($benevole = fgetcsv($file)) {
      if ($benevole[0] == $id) {
        $benevole[13] = $new_mission;
      }
      fputcsv($temporary_file, $benevole);
    }
    rewind($temporary_file);
    file_put_contents($csv_path, stream_get_contents($temporary_file));
    fclose($temporary_file);
  }
}