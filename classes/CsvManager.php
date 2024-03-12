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

      $benevole_id = $benevole[0];
      if ($benevole_id == $id) {

        $csv->closeCsv($file);
        return $benevole;
      }
    }
    $csv->closeCsv($file);
    return null;
  }

  function getEventByID($mission_id, $csvPath)
  {
    $csv = new CsvManager($csvPath);
    $file = $csv->readCsv();
    $events = $csv->readFromCsv();

    foreach ($events as $event) {
      if ($mission_id == $event[0]) {
        $csv->closeCsv($file);
        return $event;
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
    $file = fopen($this->pathToCsv, 'ab');
    if (!$file) {
      // Handle file opening error (log, report, etc.)
      die("Failed to open CSV file: " . $this->pathToCsv);
    }
    return $file;
  }

  function writeIntoCsv($file, $arrayToWrite)
  {
    // print_r($arrayToWrite);
    // Write data to CSV
    if (!is_resource($file)) {
      die("Error: File handle is not valid.");
    }
    if (fputcsv($file, $arrayToWrite) === false) {
      // Handle error in fputcsv()
      die("Error writing data to CSV: " . error_get_last()['message']);
    }

    // Debug: Get stream status
    $meta_data = stream_get_meta_data($file);
    // print_r($meta_data);
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


  public function search_in_csv($key, $value)
  {
    $file = $this->readCsv();
    while ($row = fgetcsv($file)) {
      // print_r($row[$key]);
      if ($row[$key] == $value) {
        $this->closeCsv($file);
        return true;
      }
    }
    $this->closeCsv($file);
    return false;
  }
}
