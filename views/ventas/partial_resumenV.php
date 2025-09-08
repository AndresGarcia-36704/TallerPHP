<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Resumen de Ventas</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #333; padding:6px; text-align:left; }
    th { background:#eee; }
  </style>
</head>
<body>
  <h2>Resumen de Ventas</h2>
  <table>
    <thead>
      <tr><th>ID</th><th>Cliente</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Fecha</th></tr>
    </thead>
    <tbody>
      <?php foreach($ventas as $v): ?>
      <tr>
        <td><?=htmlspecialchars($v->id)?></td>
        <td><?=htmlspecialchars($v->cliente)?></td>
        <td><?=htmlspecialchars($v->producto)?></td>
        <td><?=number_format($v->cantidad)?></td>
        <td><?=number_format($v->precio,0,',','.')?></td>
        <td><?=number_format($v->cantidad * $v->precio,0,',','.')?></td>
        <td><?=htmlspecialchars($v->fecha)?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Resumen</h3>
  <p>Total ventas: <?= $total ?></p>
  <p>Cliente top: <?= htmlspecialchars($clienteTop['cliente']) ?> (<?= number_format($clienteTop['total'],0,',','.') ?> COP)</p>
  <p>Producto top: <?= htmlspecialchars($productoTop['producto']) ?> (<?= $productoTop['total'] ?> unidades)</p>
</body>
</html>
