@extends('tablar::page')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Administración
                    </div>
                    <h2 class="page-title">
                        Ajustes
                    </h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        {{-- @can('Guardar ajustes') --}}
                            <button type="submit" form="form-ajustes" class="btn btn-primary d-none d-sm-inline-block">
                                <i class="ti ti-device-floppy"></i>
                                Guardar cambios
                            </button>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <form id="form-ajustes" action="{{ route('admin.ajustes.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">Configuración de la Clinica</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <small class="text-muted"><span class="text-danger">*</span> Campos requeridos</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-building"></i>
                                    </span>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                        name="nombre" required value="{{ old('nombre', $ajuste?->nombre) }}"
                                        placeholder="Nombre de la clinica">
                                </div>
                                @error('nombre')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Descripcion</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-notes"></i>
                                    </span>
                                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"
                                        name="descripcion" value="{{ old('descripcion', $ajuste?->descripcion) }}"
                                        placeholder="Breve descripcion">
                                </div>
                                @error('descripcion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Direccion <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-map-pin"></i>
                                    </span>
                                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                                        name="direccion" required value="{{ old('direccion', $ajuste?->direccion) }}"
                                        placeholder="Direccion de la clinica">
                                </div>
                                @error('direccion')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefono <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-phone"></i>
                                    </span>
                                    <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                        name="telefono" required value="{{ old('telefono', $ajuste?->telefono) }}"
                                        placeholder="Numero de telefono">
                                </div>
                                @error('telefono')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" required value="{{ old('email', $ajuste?->email) }}"
                                        placeholder="Correo electronico">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Divisa <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-currency-dollar"></i>
                                    </span>
                                    <select class="form-select @error('divisa') is-invalid @enderror" name="divisa" required>
                                        <option value="">Seleccionar divisa</option>
                                        @foreach ($divisas as $divisa)
                                            <option value="{{ $divisa['code'] }}"
                                                {{ old('divisa', $ajuste?->divisa) == $divisa['code'] ? 'selected' : '' }}>
                                                {{ $divisa['symbol_native'] }} - {{ $divisa['code'] }}
                                                ({{ $divisa['name'] }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('divisa')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Web</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-world"></i>
                                    </span>
                                    <input type="text" class="form-control @error('web') is-invalid @enderror"
                                        name="web" value="{{ old('web', $ajuste?->web) }}"
                                        placeholder="https://www.miclinica.com">
                                </div>
                                @error('web')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Logo</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ti ti-photo"></i>
                                    </span>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        name="logo" id="logo-input" accept="image/*">
                                </div>
                                @error('logo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="mt-2 text-center" id="logo-preview">
                                    @if (!empty($ajuste?->logo))
                                        <img src="{{ asset('storage/' . $ajuste->logo) }}" alt="Logo"
                                            class="img-thumbnail" style="max-height: 120px;">
                                    @else
                                        <div class="border rounded d-flex align-items-center justify-content-center text-muted"
                                            style="height: 120px; max-width: 200px; margin: 0 auto;">
                                            <i class="ti ti-photo" style="font-size: 2rem;"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('logo-input').addEventListener('change', function(e) {
            var preview = document.getElementById('logo-preview');
            var file = e.target.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    preview.innerHTML = '<img src="' + event.target.result +
                        '" alt="Logo" class="img-thumbnail" style="max-height: 120px;">';
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML =
                    '<div class="border rounded d-flex align-items-center justify-content-center text-muted" style="height: 120px; max-width: 200px; margin: 0 auto;"><i class="ti ti-photo" style="font-size: 2rem;"></i></div>';
            }
        });
    </script>
@endsection