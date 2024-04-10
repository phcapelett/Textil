@extends('layouts/contentLayoutMaster')

@section('title', 'CADASTRO DE ESPECIALIDADES')

@section('content')
<!-- chamados list start -->
<section class="app-chamado-list">
    <div class="row" style="align-content: space-between; justify-content: space-between;">
        
        <!-- list and filter start -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
            <section id="multiple-column-form">
  <div class="row">
    <div class="col-12">
      <div class="card">
            <div class="card-header">
            <h4 class="card-title">Inclusão de Nova Especialidade</h4>
            </div>
            <div class="card-body">
            <form class="form" method="post" action="/especialidades/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" value="{{$especialidade->id}}" />
                <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Código</label>
                    <input
                        type="text"
                        id="codigo"
                        class="form-control"
                        placeholder="Código da ESPECIALIDADE"
                        name="codigo"
                        value="{{$especialidade->codigo}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Profissão</label>
                    <input
                        type="text"
                        id="profissao"
                        class="form-control"
                        placeholder="Descrição da PROFISSÃO"
                        name="profissao"
                        value="{{$especialidade->profissao}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Orgão</label>
                    <input
                        type="text"
                        id="orgao"
                        class="form-control"
                        placeholder="Descrição do ORGÃO"
                        name="orgao"
                        value="{{$especialidade->orgao}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Número do Registro</label>
                    <input
                        type="text"
                        id="nregistro"
                        class="form-control"
                        placeholder="Código do REGISTRO"
                        name="nregistro"
                        value="{{$especialidade->nregistro}}"
                    />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="first-name-column">Status</label>
                    <input
                        type="text"
                        id="status"
                        class="form-control"
                        placeholder="Status"
                        name="status"
                        value="{{$especialidade->status}}"
                    />
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-1">Salvar</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
            </div>
        </div>
        <!-- Modal to add new user Ends-->
    </div>
  <!-- list and filter end -->
</section>
<!-- chamado list ends -->
@endsection

@section('page-script')
@endsection