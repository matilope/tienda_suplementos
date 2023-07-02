<?php

class Alerta
{

    /**
     * Guarda en el session una alerta con el tipo y el mensaje
     * @param string $tipo tipo de alerta
     * @param string $mensaje texto informativo para el usuario
     * @return void
     */
    public function crearAlerta(string $tipo, string $mensaje): void
    {
        $_SESSION['alerta'][0] = [
            'tipo' => $tipo,
            'mensaje' => $mensaje
        ];
    }

    /**
     * Vacia la alerta para que no aparezca en otros lugares
     * @return void 
     */
    public function limpiarAlerta(): void
    {
        unset($_SESSION['alerta']);
    }

    /**
     * @return string|null devuelve un string de la alerta o null en caso de no haber
     */
    public function getAlerta(): ?string
    {
        $alerta = $_SESSION['alerta'] ?? [];
        if (!empty($alerta)) {
            $mensaje = $this->crearHtml($alerta);
            $this->limpiarAlerta();
            return $mensaje;
        } else {
            return null;
        }
    }

    /**
     * @param array el array de alerta con el tipo y el mensaje.
     * @return string devuelve el html con el tipo de alerta y el mensaje
     */
    private function crearHtml(array $alerta): string
    {
        $html = "<div class='alert alert-{$alerta[0]['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alerta[0]['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= "</div>";    
        return $html;
    }
}
