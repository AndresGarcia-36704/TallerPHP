<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Resumen de Empleados</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    table { width:100%; border-collapse: collapse; }
    th, td { border:1px solid #333; padding:6px; text-align:left; }
    th { background:#eee; }
  </style>
</head>
<body>
  <h2>Resumen de Empleados</h2>
  <h3>Promedio por departamento</h3>
  <table>
    <thead><tr><th>Departamento</th><th>Promedio</th></tr></thead>
    <tbody>
      <?php foreach($promedios as $d=>$p): ?>
      <tr><td><?=htmlspecialchars($d)?></td><td><?=number_format($p,0,',','.')?> COP</td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h3>Departamento con mayor promedio</h3>
  <p><?= $mayor['departamento'] ?> (<?= number_format($mayor['promedio'],0,',','.') ?> COP)</p>

  <h3>Empleados sobre el promedio</h3>
  <ul>
    <?php foreach($sobrePromedio as $e): ?>
    <li><?= htmlspecialchars($e->nombre) ?> - <?= htmlspecialchars($e->departamento) ?> (<?= number_format($e->salario,0,',','.') ?> COP)</li>
    <?php endforeach; ?>
  </ul>
</body>
</html>
