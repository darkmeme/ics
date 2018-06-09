@component('mail::message')



Estimad@ <strong>@if(isset($tarjeta->user_reasignado))
            {{$tarjeta->reasignado->name}} 
          @else {{$tarjeta->asignado->name}}                   
          @endif
</strong> se le ha asignado esta tarjeta:
<br>
@component('mail::panel')
<h5><strong>Numero: </strong><span>{{$tarjeta->id}} </span></h5>
<h5><strong>Fecha: </strong><span>{{$tarjeta->created_at}}</span> </h5>
<h5><strong>Area: </strong><span>{{$tarjeta->area->nombre}} </span></h5>
<h5><strong>Planta: </strong><span class="blue">{{$tarjeta->planta->nombre}} </span></h5>
<h5><strong>Prioridad: </strong><span class="blue">{{$tarjeta->prioridad}} </span></h5>
<h5><strong>Descripcion del Reporte: </strong><span class="blue">{{$tarjeta->descripcion_reporte}}</span> </h5>
@if(isset($tarjeta->user_reasignado))
<h5><strong>Motivo: </strong><span class="blue">{{$tarjeta->motivo_reasignado}}</span> </h5>
@endif 
@endcomponent

@component('mail::button', ['url' => 'http://digital-cic.com/tarjetas/'.$tarjeta->id])
Ver Tarjeta
@endcomponent

<br>
Sistema de Tarjetas CIC
@endcomponent
  