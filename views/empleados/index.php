<div class="row">
  <!-- Tabla empleados -->
  <div class="col-12 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="card-title">Lista de Empleados</h3>
        <table class="table table-striped table-hover">
          <thead class="table-dark">
            <tr><th>Nombre</th><th>Departamento</th><th>Salario</th></tr>
          </thead>
          <tbody>
            <?php foreach ($this->empleados as $e): ?>
            <tr>
              <td><?= htmlspecialchars($e->nombre) ?></td>
              <td><?= htmlspecialchars($e->departamento) ?></td>
              <td><?= number_format($e->salario,0,',','.') ?> COP</td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Resumen -->
  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Promedio por departamento</h4>
        <ul class="list-group">
          <?php foreach($promedios as $d=>$p): ?>
            <li class="list-group-item d-flex justify-content-between">
              <span><?= htmlspecialchars($d) ?></span>
              <strong><?= number_format($p,0,',','.') ?> COP</strong>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Departamento con mayor promedio</h4>
        <p class="lead"><?= $mayor['departamento'] ?> 
          (<strong><?= number_format($mayor['promedio'],0,',','.') ?> COP</strong>)
        </p>
      </div>
    </div>
  </div>

  <div class="col-12 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Empleados sobre el promedio</h4>
        <ul class="list-group">
          <?php foreach($sobrePromedio as $e): ?>
            <li class="list-group-item">
              <?= htmlspecialchars($e->nombre) ?> - 
              <strong><?= number_format($e->salario,0,',','.') ?> COP</strong>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

  <!-- Acciones -->
  <div class="col-12">
    <div class="d-flex gap-3">
      <form method="post" action="?page=empleados&action=descargar_resumen">
        <button class="btn btn-danger">📄 Descargar PDF</button>
      </form>
      <form method="post" action="?page=empleados&action=enviar_resumen" class="d-flex gap-2">
        <input type="email" name="email" placeholder="correo@ejemplo.com" 
               required class="form-control w-auto" />
        <button class="btn btn-primary">✉️ Enviar por Correo</button>
      </form>
    </div>
  </div>
</div>
