<x-mail::message>
# Nuevo lead desde chat Ruguex Bobcat

Hola, llegó una nueva solicitud desde el chat de llantas Bobcat.

### Datos del prospecto

**Nombre:** {{ $lead['nombre'] }}

**Empresa:** {{ $lead['empresa'] ?: 'No especificada' }}

**Tipo de llanta:** {{ $lead['tipo_llanta'] }}

**Medida:** {{ $lead['medida'] }}

**Teléfono:** {{ $lead['telefono'] }}

**Correo:** {{ $lead['correo'] }}

### Mensaje del prospecto

{{ $lead['mensaje'] ?: 'Sin mensaje' }}

### Origen

{{ $lead['origen'] ?: 'No especificado' }}

<x-mail::button :url="'mailto:' . $lead['correo']">
Responder ahora
</x-mail::button>

Gracias,  
**Sistema Ruguex**
</x-mail::message>