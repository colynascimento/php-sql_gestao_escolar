<?php
    function alert($mensagem, $caminho) {
    echo "<script>
            alert('$mensagem');
            window.location.href = '$caminho';
        </script>";
    }
?>