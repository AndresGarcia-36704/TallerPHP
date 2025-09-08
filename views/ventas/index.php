<div class="row">
  <!-- Resumen -->
  <div class="col-md-4 mb-4">
    <div class="card shadow-sm text-center">
      <div class="card-body">
        <h5>Total de ventas</h5>
        <p class="display-6"><?= $total ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm text-center">
      <div class="card-body">
        <h5>Cliente que más gastó</h5>
        <p class="lead"><?= $clienteTop['cliente'] ?></p>
        <strong><?= number_format($clienteTop['total'],0,',','.') ?> COP</strong>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card shadow-sm text-center">
      <div class="card-body">
        <h5>Producto más vendido</h5>
        <p class="lead"><?= $productoTop['producto'] ?></p>
        <strong><?= $productoTop['total'] ?> unidades</strong>
      </div>
    </div>
  </div>
</div>

<!-- Acciones -->
<div class="row mt-3">
  <div class="col-md-6">
    <form method="post" action="?action=enviar_resumen" class="card card-body shadow-sm">
      <h5 class="mb-3">Enviar resumen por correo</h5>
      <input type="email" name="email" class="form-control mb-2" 
             placeholder="correo@ejemplo.com" required>
      <button class="btn btn-primary w-100">✉️ Enviar PDF</button>
    </form>
  </div>

  <div class="col-md-6">
    <form method="post" action="?action=descargar_resumen" class="card card-body shadow-sm">
      <h5 class="mb-3">Descargar resumen</h5>
      <button class="btn btn-outline-secondary w-100">📄 Descargar PDF</button>
    </form>
  </div>
</div>
