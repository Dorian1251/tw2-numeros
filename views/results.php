<div class="mt-4">
    <h5 class="mb-3">Resultados</h5>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Índice</th>
                    <th>Número aleatorio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($numbers as $index => $number): ?>
                <tr>
                    <td><?php echo $renderer->escape($index + 1); ?></td>
                    <td><?php echo $renderer->escape($number); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr class="table-secondary fw-bold">
                    <td>Suma</td>
                    <td><?php echo $renderer->escape($stats['sum']); ?></td>
                </tr>
                <tr class="table-secondary fw-bold">
                    <td>Promedio</td>
                    <td><?php echo $renderer->escape(number_format($stats['average'], 2)); ?></td>
                </tr>
                <tr class="table-secondary fw-bold">
                    <td>Mínimo</td>
                    <td><?php echo $renderer->escape($stats['min']); ?></td>
                </tr>
                <tr class="table-secondary fw-bold">
                    <td>Máximo</td>
                    <td><?php echo $renderer->escape($stats['max']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
