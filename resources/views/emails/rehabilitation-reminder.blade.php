O programa de reabilitação do doente <strong>{{ $rehabilitation->patient->name }}</strong> termina no dia <strong>{{ $rehabilitation->ended_at }}</strong>.

<dl>
    <dt>Identificador:</dt>
    <dd>{{ $rehabilitation->id }}</dd>
    <dt>Doente:</dt>
    <dd>{{ $rehabilitation->patient->name }} (#{{ $rehabilitation->patient->id }})</dd>
    <dt>Data de inicio:</dt>
    <dd>{{ $rehabilitation->started_at }}</dd>
    <dt>Data de término:</dt>
    <dd>{{ $rehabilitation->ended_at }}</dd>
</dl>