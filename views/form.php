<form method="POST" action="./index.php">
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p class="mb-0"><?php echo $renderer->escape($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="n" class="form-label">Cantidad de números (n): *</label>
        <input type="number" class="form-control" id="n" name="n" value="<?php echo $renderer->escape($n); ?>" min="1" max="1000" required>
        <div class="form-text">Ingrese un valor entre 1 y 1000</div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="min" class="form-label">Valor mínimo (opcional)</label>
            <input type="number" class="form-control" id="min" name="min" value="<?php echo $renderer->escape($min); ?>">
        </div>

        <div class="col-md-6 mb-3">
            <label for="max" class="form-label">Valor máximo (opcional)</label>
            <input type="number" class="form-control" id="max" name="max" value="<?php echo $renderer->escape($max); ?>">
        </div>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Generar</button>
    </div>
</form>
