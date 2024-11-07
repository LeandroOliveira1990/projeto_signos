<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body text-center">
            <?php
            // Recebe a data de nascimento do formulário
            $data_nascimento = $_POST['data_nascimento'];

            // Carrega o arquivo XML
            $signos = simplexml_load_file("signos.xml");

            function converterData($data) {
                // Converte uma data no formato dd/mm para o formato mmdd (ex.: 09/01 -> 0109)
                $partes = explode("/", $data);
                return $partes[1] . $partes[0];
            }

            // Extrai o mês e dia da data de nascimento do usuário no formato mmdd
            $data_nascimento_formatada = converterData(date("d/m", strtotime($data_nascimento)));

            $signo_encontrado = null;

            // Itera pelos signos para encontrar o correspondente
            foreach ($signos->signo as $signo) {
                $inicio = converterData((string) $signo->dataInicio);
                $fim = converterData((string) $signo->dataFim);

                // Tratamento especial para Capricórnio (de 22/12 a 19/01)
                if ($inicio > $fim) {
                    if ($data_nascimento_formatada >= $inicio || $data_nascimento_formatada <= $fim) {
                        $signo_encontrado = $signo;
                        break;
                    }
                } else {
                    // Para os outros signos com intervalo regular
                    if ($data_nascimento_formatada >= $inicio && $data_nascimento_formatada <= $fim) {
                        $signo_encontrado = $signo;
                        break;
                    }
                }
            }

            if ($signo_encontrado) {
                echo "<h2>Seu signo é: " . htmlspecialchars($signo_encontrado->signoNome) . "</h2>";
                echo "<p>Descrição: " . htmlspecialchars($signo_encontrado->descricao) . "</p>";
            } else {
                echo "<p>Desculpe, não foi possível identificar seu signo.</p>";
            }
            ?>
            <p><a href="index.php" class="btn btn-primary mt-3">Voltar</a></p>
        </div>
    </div>
</div>

</body>
</html>
