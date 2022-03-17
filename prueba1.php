<?php
  // require_once 'vendor/autoload.php';
  require __DIR__ .  '/vendor/autoload.php';

  // Agrega credenciales
  //Credenciales prod
 // MercadoPago\SDK::setAccessToken('APP_USR-1855274929528659-092301-c1c2129db7d006573f4bf604014a356f-649768075');

//$publicKey= "APP_USR-f52ada28-884d-425b-81ad-d12f43d34eb2";

//credeciales prueba

 MercadoPago\SDK::setAccessToken('TEST-1855274929528659-092301-3a471be242e79d6c0053a14f0476feb1-649768075');
//
 $publicKey= "TEST-0e6d3029-3ccb-4a60-bbd4-9990377260ce";


  	$body = json_decode(file_get_contents("php://input"), true);
  	//OBTENGO LA INFORMACION QUE MANDA ANDROID
    $unidades=intval($body['unidades']);
  	$email = $body['email'];
  	$importe = floatval($body['importe']);
  	$nombreProducto = $body['nombreProducto'];
  // Crea un objeto de preferencia
  $preference = new MercadoPago\Preference();


    $payer = new MercadoPago\Payer();
    $payer->email = $email;
    // $preference->payer = $payer;
  // Crea un ítem en la preferencia
  $item = new MercadoPago\Item();
  $item->title = $nombreProducto;
  $item->quantity = $unidades;
  $item->unit_price = $importe;

  $preference->payer = $payer;
  $preference->items = array($item);
  $preference->save();

$var=$preference->id;
print json_encode(
  array(
      'estado' => 1,
      'respuesta' => $var,
      'publicKey' => $publicKey,
  )
);
// var_dump( $preference);
?>
