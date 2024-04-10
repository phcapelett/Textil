@extends('layouts.contentLayoutMaster')
{{-- title --}}

@section('title',$obj->translate['table']['insert'])

{{-- vendor style --}}
@section('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/pickadate/pickadate.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/pickers/daterange/daterangepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/tags/jquery.tagsinput.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/forms/select/select2.min.css')}}">
@endsection
@section('page-styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/plugins/forms/validation/form-validation.css')}}">
<style>
    td[data-title='Horas semanais'] {
        text-align: center;
    }
</style>
@endsection

@section('content')

<lpt-jornada 
    :obj="{{json_encode($obj)}}" 
    :botoes="{{@json_encode(@$buttons)}}"
    :namemodal="{{json_encode($nameModal)}}" 
    :json="{{json_encode($json)}}" 
    :lista="{{json_encode($lista)}}"
    :btnincluir="{{json_encode(\App\Utils\Functions::permissoesGlobal($obj->urlbase, '','I',$obj->urlbase))}}"
    :btneditar="{{json_encode(\App\Utils\Functions::permissoesGlobal($obj->urlbase, '','E',$obj->urlbase))}}"
    :btnremover="{{json_encode(\App\Utils\Functions::permissoesGlobal($obj->urlbase, '','D',$obj->urlbase))}}"
    botao_title="{{@$botao_title}}"
    >
    <template v-slot:form>
        {!!  \App\Utils\Functions::montaFormulario($obj->classebase,$obj->classebase.'.json',$nameModal, $obj) !!} 
    </template>
    

    @if(@$edita_usuario)
        <template v-slot:form_usuario_filas>
        </template>

        <template v-slot:form_usuario_grupos>
        </template>
    @endif

</lpt-jornada>

@endsection
{{-- vendor scripts --}}
@section('vendor-scripts')
<script src="{{asset('vendors/js/tags/jquery.tagsinput.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/datatables.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/js/tables/datatable/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.date.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/picker.time.js')}}"></script>
<script src="{{asset('vendors/js/pickers/pickadate/legacy.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/moment.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script src="{{asset('vendors/summernote-0.8.18-dist/summernote.min.js')}}"></script>
@endsection
{{-- page scripts --}}
@section('page-scripts')
<script src="{{asset('js/scripts/forms/validation/form-validation.js')}}"></script>
<script src="{{asset('vendors/js/forms/select/select2.full.min.js')}}"></script>
@if (\App\Utils\Functions::getPermissionGeral(\Auth::user(), "", "0", "S"))
<script src="{{asset('js/table_export.js')}}"></script>
@else
<script src="{{asset('js/table.js')}}"></script>
@endif
<script>
    
    var form_cad = new PerfectScrollbar(".rolagem");
    var form_register = $('#form_painel_{{$obj->urlbase}}');
    var backgroundformoverlay = $('.background-form-overlay');
    $(function(e){
        @foreach($json->campos as $j)
            @if($j->type == "tag")
                $('#{{$j->id}}').tagsInput({
                    'defaultText':'Add Tag',
                });
            @endif
        @endforeach

        $("#Form_{{$obj->urlbase}}").submit(function (e) {
            e.preventDefault();
        });

        var loader = $('<div class="spinner-grow spinner-grow-lg center_loader" role="status"><span class="sr-only">{{$obj->global["waiting"]}}</span></div>');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("body").on('click','.open_cadastro', function(){

            $("input[type=hidden][id='id']").val('');
            $('#Form_{{$obj->urlbase}}').each (function(){
                    this.reset();
            });    

            form_register.removeClass('hideform');
            form_register.addClass('showform');
            backgroundformoverlay.addClass('showform');
        });

        $("body").on('click','.close_cadastro', function(){
            $("input[type=hidden][id='id']").val('');
            form_register.removeClass('showform');
            form_register.addClass('hideform');
            backgroundformoverlay.removeClass('showform');
        });

        $("body").on('click','.background-form-overlay', function(){
            form_register.removeClass('showform');
            form_register.addClass('hideform');
            backgroundformoverlay.removeClass('showform');
            $("input[type=hidden][id='id']").val('');
        });

        var $selectMulti = $(".select2-multiple").select2();
        $selectMulti.select2({
            dropdownAutoWidth: true,
            width: '100%',
            placeholder: "Selecione as Filas"
        });

        $('.pickadate').pickadate({
            formatSubmit: 'dd/mm/yyyy',
            monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
            monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
            weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Fechar',
            format: 'dd/mm/yyyy'
        });

        $('.inlinedatapicker').pickadate({
            format: 'DD/MM/YYYY',
            container : '#inlinecontainer',
            formatSubmit: 'dd/mm/yyyy',
            monthsFull: [ 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro' ],
            monthsShort: [ 'Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez' ],
            weekdaysShort: [ 'Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab' ],
            today: 'Hoje',
            clear: 'Limpar',
            close: 'Fechar',
            locale: {
                format: 'DD/MM/YYYY'
            }
        });

        $('.pickatime').pickatime({
            clear: 'Limpar',
        });

        $('body').on('click', '.open_classe_add', function(e){
            var name_modal = $(this).attr('data-name-modal');
            var dataformulario = $(this).attr('data-classe-return');
            $('div[id='+name_modal+']').show();
            $('.modal-backdrop').show();
            $('#'+name_modal).modal('show');
            $('#'+name_modal).html('');            
            $('#'+name_modal).html(loader);            
            $.post('/getform/'+dataformulario,'modal='+name_modal,function(data){
                loader.remove();               
                $('#'+name_modal).html('');
                $('#'+name_modal).html(data);
                $(document).ready(function(){
                    $('#fonewhats').mask("(99) 99999-9999");
                });
            });
        });

        $('body').on('click', '.close_modal_form', function(e){
            var name_modal_close = $(this).attr('name-modal-close');
            $('div[id='+name_modal_close+']').hide();
            $('.modal-backdrop').hide();
        });
        
        if ($('textarea.editorTexto').length) {
            $('.editorTexto').summernote({
                height: 200,
                focus: true
            });
        }        

        // $('.table-responsive').on('shown.bs.dropdown', function (e) {
        //     var $table = $(this),
        //         $menu = $(e.target).find('.dropdown-menu'),
        //         tableOffsetHeight = $table.offset().top + $table.height(),
        //         menuOffsetHeight = $menu.offset().top + $menu.outerHeight(true);

        //     if (menuOffsetHeight > tableOffsetHeight)
        //         $table.css("padding-bottom", menuOffsetHeight - tableOffsetHeight);
        // });

        // $('.table-responsive').on('hide.bs.dropdown', function () {
        //     $(this).css("padding-bottom", 0);
        // })       
    });
</script>
@endsection