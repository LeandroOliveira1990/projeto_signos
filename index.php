<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <h2 class="text-center">Descubra seu Signo</h2>
    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-4">
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Consultar Signo</button>
        </div>
    </form>
</div>

</body>
</html>
