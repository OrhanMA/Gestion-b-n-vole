<?php

class CsvManager
{
  public $pathToCsv;
  function __construct($pathToCsv)
  {
    $this->pathToCsv = $pathToCsv;
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
}