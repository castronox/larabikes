<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public string $type;
    public string $message;

    // Crear una nueva instancia del componente.
    public function __construct(string $type = 'warning', string $message = '')
    {
        $this->type = $type;
        $this->message = $message;
    }

    // Capturar la vista / contiene la representación del Componente.
    public function render()
    {
        return <<<'blade'
        
        <div class="alert alert-{{ $type }}">
            <p>{{ $message }} </p>
            {{$slot}}
        </div>
        blade;
    }
}
