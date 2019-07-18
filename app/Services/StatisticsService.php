<?php

namespace App\Services;

class StatisticsService
{
    public function genre_list(){
      $genre_list=['Rock','Metal','Hard rock','Heavy metal','Screamo','Grunge','Thrash metal','Classic rock','Alternative rock','Southern Rock','Numetal',
      'Pop','Metalcore','Alternative metal','Emo','Deathcore','Dance','House','Post-hardcore','Pop rock','Rnb','90s','80s','70s','Classical'];
      //genre list
      foreach ($genre_list as $key => $value) { //set array values to 0
        for ($z=0; $z <count($genre_list) ; $z++) {
          $g[$value] = 0;
        }
      }
      return $g;
    }

    public function globalStatistics($genre){
      $g = $this->genre_list();
      foreach ($genre as $key) {
        $result[] = $key->genre; //get genre from array
      }
      for ($i=0; $i < count($result); $i++) { //explode results and put into array
        $array[] = explode(',', $result[$i]);
      }
      for($k = 0; $k < count($array); $k++){ //put results into one array
         for($j = 0; $j < count($array[$k]); $j++) {
             $one_array[] = $array[$k][$j];
          }
      }
      for ($l=0; $l <count($one_array) ; $l++) {  //some fancy styling
        $fancy_array[] = ucfirst(str_replace('_', ' ', $one_array[$l]));
      }
      $genre_sort = array_count_values($fancy_array); //sort by genre
      $g_m = array_merge($g,$genre_sort);

      // dd($genre_sort, $g,);
      // $rock = $g_m['Rock']+$g_m['Hard rock']+$g_m['Classic rock']+$g_m['Alternative rock']+$g_m['Southern Rock'];
      // $pop = $g_m['Pop'];
      // $metal = $g_m['Metal']+$g_m['Metalcore']+$g_m['Alternative metal']+$g_m['Emo']+$g_m['Deathcore'];
      // dd($g_m);
      $globalGenres = array(
        "Rock" => $g_m['Rock'], "Pop" => $g_m['Pop'], "Metal" => $g_m['Metal'], "Metalcore" => $g_m['Numetal'],
        "Hard rock" => $g_m['Hard rock'], 'Alternative rock' => $g_m['Alternative rock'], 'Alternative metal' => $g_m['Alternative metal'],
        "Deathcore" => $g_m['Deathcore'], 'Post-hardcore' => $g_m['Post-hardcore'], "90s" => $g_m['90s'], "80s" => $g_m['80s'],
        "70s" => $g_m['70s'], "Heavy metal" => $g_m['Heavy metal'], "Thrash metal" => $g_m['Thrash metal'], "Screamo" => $g_m['Screamo'],
        "Grunge" => $g_m['Grunge'], "Classical" => $g_m['Classical']
      );
      $globalStats = array_filter($globalGenres, function($value){
          return ($value > 0);
      });
      foreach ($globalStats as $key => $value) {
        $k_genre[] = "'".$key."'";
      }
      foreach ($globalStats as $key => $value) {
        $v_genre[] = $value;
      }
      $value_genre = implode(', ', $v_genre);
      $key_genre = implode(', ', $k_genre);
      $results[] = [$value_genre, $key_genre];

      // return dd($g_m);
      return $results;
    }

    public function userStatistics($genre){
      $g = $this->genre_list();
      foreach ($genre as $key) {
        $result[] = $key->genre; //get genre from array
      }
      if(isset($result)){
      for ($i=0; $i < count($result); $i++) { //explode results and put into array
        $array[] = explode(',', $result[$i]);
      }
      for($k = 0; $k < count($array); $k++){ //put results into one array
         for($j = 0; $j < count($array[$k]); $j++) {
             $one_array[] = $array[$k][$j];
          }
      }
      for ($l=0; $l <count($one_array) ; $l++) {  //some fancy styling
        $fancy_array[] = ucfirst(str_replace('_', ' ', $one_array[$l]));
      }
      $genre_sort = array_count_values($fancy_array); //sort by genre
      $g_m = array_merge($g,$genre_sort);

      // dd($genre_sort, $g,);
      // $rock = $g_m['Rock']+$g_m['Hard rock']+$g_m['Classic rock']+$g_m['Alternative rock']+$g_m['Southern Rock'];
      // $pop = $g_m['Pop'];
      // $metal = $g_m['Metal']+$g_m['Metalcore']+$g_m['Alternative metal']+$g_m['Emo']+$g_m['Deathcore'];

      $userGenres = array(
        "Rock" => $g_m['Rock'], "Pop" => $g_m['Pop'], "Metal" => $g_m['Metal'], "Metalcore" => $g_m['Numetal'],
        "Hard rock" => $g_m['Hard rock'], 'Alternative rock' => $g_m['Alternative rock'], 'Alternative metal' => $g_m['Alternative metal'],
        "Deathcore" => $g_m['Deathcore'], 'Post-hardcore' => $g_m['Post-hardcore'], "90s" => $g_m['90s'], "80s" => $g_m['80s'],
        "70s" => $g_m['70s'], "Heavy metal" => $g_m['Heavy metal'], "Thrash metal" => $g_m['Thrash metal'], "Screamo" => $g_m['Screamo'],
        "Grunge" => $g_m['Grunge'], "Classical" => $g_m['Classical']
      );
      $userStats = array_filter($userGenres, function($value){
          return ($value > 0);
      });
      foreach ($userStats as $key => $value) {
        $k_genre[] = "'".$key."'";
      }
      foreach ($userStats as $key => $value) {
        $v_genre[] = $value;
      }
      $value_genre = implode(', ', $v_genre);
      $key_genre = implode(', ', $k_genre);
      $results[] = [$value_genre, $key_genre];


      // return dd($g_m);
      return $results;
        }else{
          $results = false;
        }
    }
}
