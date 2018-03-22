@component('mail::message')

Lecturas de energia tomadas por: <strong>{{$user}}</strong>
<br>
@component('mail::panel')
<h5><strong>Registro No: </strong><span>{{$medidores->id}} </span></h5>
<h5><strong>Nsd 220: </strong><span>{{$medidores->nsd_220}}</span> </h5>
<h5><strong>Nsd 480: </strong><span>{{$medidores->nsd_480}} </span></h5>
<h5><strong>Blanqueo: </strong><span>{{$medidores->blanqueo}} </span></h5>
<h5><strong>Calderas: </strong><span>{{$medidores->calderas}} </span></h5>
<h5><strong>Sulfonacion: </strong><span>{{$medidores->sulfonacion}} </span></h5>
<h5><strong>Oficinas: </strong><span>{{$medidores->oficinas}} </span></h5>
<h5><strong>Daf: </strong><span>{{$medidores->daf}} </span></h5>
<h5><strong>Comby: </strong><span>{{$medidores->comby}} </span></h5>
<h5><strong>Saponificacion: </strong><span>{{$medidores->saponificacion}} </span></h5>
<h5><strong>Enee Principal: </strong><span>{{$medidores->enee_principal}} </span></h5>
<h5><strong>Enee Reactivo: </strong><span>{{$medidores->enee_reactivo}} </span></h5>
@endcomponent

<br>
Sistema de Reportes CIC
@endcomponent
