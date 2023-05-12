<?php
  header('content-type: application/json');

  $province = $_GET['province'];

  $response = [];

  switch ($province) {
    case 'jakarta':
      $response[] = ['name' => 'Jakarta Barat', 'value' => 'jakarta barat'];
      $response[] = ['name' => 'Jakarta Timur', 'value' => 'jakarta timur'];
      $response[] = ['name' => 'Jakarta Selatan', 'value' => 'jakarta selatan'];
      $response[] = ['name' => 'Jakarta Utara', 'value' => 'jakarta utara'];

      break;
    case 'banten':
      $response[] = ['name' => 'Kota Tangerang', 'value' => 'kota tangerang'];
      $response[] = ['name' => 'Tangerang', 'value' => 'tangerang'];
      $response[] = ['name' => 'Tangerang Selatan', 'value' => 'tangerang selatan'];
      $response[] = ['name' => 'Serang', 'value' => 'serang'];

      break;
  }

  echo json_encode($response);
?>
