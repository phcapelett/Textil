@extends('menuVertical')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card text-center">
                    <h5 class="card-header">LISTA RAMAIS</h5>
                    <div class="row">
                        <div class="col-sm-6 mb-3 mb-sm-1">
                            <div class="table-responsive">{{-- PRIMEIRA COLUNA DA LISTA DE RAMAIS --}}
                                <table class="table nowrap scroll-horizontal-vertical dataex-html5-selectors table-hover table-secondary mb-sm-0">
                                    <thead class="table-dark">
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-telephone"></i></th>
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-person"></i></th>
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-building"></i></th>
                                    </thead>
                                    <tbody class="text-center" style="font-weight: bold">
                                        <tr><td>9</td><td>MARIA EDUARDA</td><td class="text-center">RECEPÇÃO</td></tr>
                                        <tr><td>5666</td><td>ISABELA</td><td class="text-center">FINANCEIRO</td></tr>
                                        <tr><td>5670</td><td>PATRICIA</td><td class="text-center">DESENVOLVIMENTO</td></tr>
                                        <tr><td>5671</td><td>RUTI</td><td class="text-center">DESENVOLVIMENTO</td></tr>
                                        <tr><td>5672</td><td>LUCIANE</td><td class="text-center">DESENVOLVIMENTO</td></tr>
                                        <tr><td>5673</td><td>PAULO</td><td class="text-center">T.I</td></tr>                                
                                    </tbody>  
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">{{-- SEGUNDA COLUNA DA LISTA DE RAMAIS --}}
                                <table class="table nowrap scroll-horizontal-vertical dataex-html5-selectors table-hover table-secondary mb-sm-0">
                                    <thead class="table-dark">
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-telephone"></i></th>
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-person"></i></th>
                                        <th class="text-center" style="font-size: 1.4rem; font-weight: bold"><i class="bi bi-building"></i></th>
                                    </thead>
                                    <tbody class="text-center" style="font-weight: bold">
                                        <tr><td>5684</td><td>GUILHERME</td><td class="text-center">EXPEDIÇÃO</td></tr>
                                        <tr><td>5685</td><td>ADRIANO</td><td class="text-center">COMERCIAL</td></tr>
                                        <tr><td>5690</td><td>BETO</td><td class="text-center">GERÊNCIA</td></tr>
                                        <tr><td>8332</td><td>VIVIANE</td><td class="text-center">CORTE VIES</td></tr>
                                        <tr><td>8346</td><td>AVIAMENTOS</td><td class="text-center">ALMOXARIFADO</td></tr>
                                        <tr><td>5675</td><td>LUCIANA</td><td class="text-center">COMPRAS</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection