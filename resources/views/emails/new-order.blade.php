<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Nuevo Pedido</title>
</head>
<body>
<table style="width: 65%; padding: 10px; margin:0 auto; border-collapse: collapse;">
	<tr>
		<td style="background-color: #fff; text-align: left; padding: 0">
			<div align="center">
				<img width="40%" style="display:block; margin: 1.5% 3%;" src="">
      </div>
		</td>
	</tr>
	<tr>
		<td style="background-color: #fff">
			<div style="color: #34495e; margin: 4% 10% 2%;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px; text-align:center">Nuevo pedido</h2>
				<p style="margin: 2px; font-size: 15px; text-align:center">
          Datos del cliente: <br>
          <hr>
        </p>
          <table>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td width="20%">{{ $user->name }}</td>
                <td width="60%">{{ $user->address}} {{ $user->postal_code}}</td>
                <td width="20%">{{ $user->phone}}</td>
              </tr>
            </tbody>
          </table>
        <hr>
        <p style="margin: 2px; font-size: 15px; text-align:center">
          Detalles del pedido:<br>
          <hr>
        </p>
				<table>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cart->details as $detail)
              <tr>
                <td style="text-align:center" width="60%">{{ $detail->product->name}}</td>
                <td style="text-align:center" width="60%">{{ $detail->quantify }}</td>
                <td style="text-align:center" width="60%">$ {{ $detail->subtotal }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        <br>
        <p align="right">
         <strong> Total:</strong> $ {{ $cart->total }}
        </p>
				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href=" {{ route('detalles.pedido', array($cart->id , $user->id)) }} ">Ver detalles</a>
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">© 2019 Todos los Derechos Reservados.</p>
			</div>
		</td>
	</tr>
</table>
</body>
</html>