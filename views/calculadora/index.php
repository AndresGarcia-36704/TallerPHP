<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<div class="row">
  <!-- Interés compuesto -->
  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Interés Compuesto</h4>
        <form method="POST">
          <div class="mb-2">
            <label class="form-label">Capital</label>
            <input class="form-control" type="number" name="capital" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Tasa (%)</label>
            <input class="form-control" type="number" step="0.01" name="tasa" required>
          </div>
          <div class="mb-2">
            <label class="form-label">Plazo (años)</label>
            <input class="form-control" type="number" name="plazo" required>
          </div>
          <button class="btn btn-primary w-100">Calcular</button>
        </form>
        <?php if($interes!==null): ?>
          <div class="alert alert-success mt-3">
            Resultado: <?= number_format($interes,2) ?> COP
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Salario neto -->
  <div class="col-md-6 mb-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Salario Neto</h4>
        <form method="POST">
          <div class="mb-2">
            <label class="form-label">Salario bruto</label>
            <input class="form-control" type="number" name="salario" required>
          </div>
          <button class="btn btn-primary w-100">Calcular</button>
        </form>
        <?php if($salarioNeto!==null): ?>
          <div class="alert alert-success mt-3">
            Resultado: <?= number_format($salarioNeto,2) ?> COP
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
