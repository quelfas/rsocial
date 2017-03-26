@forelse($conditions as $condition)
    <p>{{ $condition->discapacidad }}</p>
@empty
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#conditionForm">
      Ingrese su discapacidad <i class="fa fa-wheelchair" aria-hidden="true"></i>
    </button>
@endforelse