<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <!--CARD HEADER-->
                        <div class="card-grid">
                            <span class="fs-4 fw-semibold">{{ this.obj.translate.table.bread }}</span>
                            <div class="grid-search">
                                <label for="buscaDesc" class="pesquisar fs-5 px-2">Pesquisar</label>
                                <input
                                    type="text"
                                    id="buscaDesc"
                                    class="form-control fs-6"
                                    placeholder="Buscar"
                                />
                            </div>
                            <a href="#" class="btn btn-sm btn-success fs-6 header-button"
                                data-bs-toggle="modal" 
                                data-bs-target="#staticBackdrop"
                            >{{ this.obj.global.insert_abr }}</a>
                        </div>
                    </div>

                    <!--GRID TABLE INDEX-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive table-radius-bottom-left-right">
                                <table class="table nowrap scroll-horizontal-vertical dataex-html5-selectors table-hover table-secondary mb-sm-0">
                                    <thead class="table-dark">
                                        <tr class="text-left">
                                            <template v-for="lt in colunas">
                                                <th v-if="lt.show">
                                                    {{ getColumNameGrid(lt.nome) }}
                                                </th>
                                            </template>
                                            <th class="text-center">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left">
                                        <tr v-for="(item, index) in paginatedListagem" :key="item.id"
                                            @click="editarGrid(index,item)" :title="obj.global.edit">

                                            <template v-for="coluna in colunas">
                                                <td v-if="coluna.show && (coluna.nome =='status' || coluna.nome == 'isdefault')"
                                                    v-html="getValueColumnGrid(item,coluna,'S')">
                                                </td>
                                                <td v-if="coluna.show && coluna.nome != 'status' && coluna.nome != 'isdefault'">
                                                    <template v-if="coluna.date == true && coluna.time == true">
                                                        {{ getValueColumnGrid(item,coluna,"N") | formatDate }}
                                                    </template>
                                                    <template v-if="coluna.date == true && coluna.time == false">
                                                        {{ $filters.formatDate(getValueColumnGrid(item,coluna,"N")) }}
                                                    </template>
                                                    <template v-if="coluna.date == false && coluna.time == true">
                                                        {{ getValueColumnGrid(item,coluna,"N") | time }}
                                                    </template>
                                                    <template v-if="coluna.date == false && coluna.time == false">
                                                        {{ getValueColumnGrid(item,coluna,"N") }}
                                                    </template>
                                                </td>
                                            </template>
                                            <td class="text-center">
                                                <div @click.stop>
                                                    <!-- <a v-if="validPermissionGlobal(auth,'DELETE')" -->
                                                    <a
                                                        class="btn btn-icon rounded-circle btn-light-danger"
                                                        :title="obj.global.remove"
                                                        @click="removerGrid(item)" href="#">
                                                        <i class="material-icons trash-red" title="Remover">delete</i>
                                                    </a>
                                                    <!-- <template v-if="botoes">
                                                        <template v-for="but in botoes">
                                                            <a v-if="!but.actionmodal"
                                                                :key="genUniqueKey(but)"
                                                                class="btn btn-icon rounded-circle btn-light-primary"
                                                                :href="getUrlButtonGrid(but,item)"
                                                                :title="but.text"
                                                                v-html="but.classe">
                                                            </a>
                                                            <a v-if="but.actionmodal"
                                                                :key="genUniqueKey(but)"
                                                                @click="editarGridFilas(item)"
                                                                data-toggle="modal"
                                                                :data-target="getIdModal(but)"
                                                                class="btn btn-icon rounded-circle btn-light-primary"
                                                                href="#"
                                                                :title="but.text"
                                                                v-html="but.classe"
                                                            ></a>
                                                        </template>
                                                    </template> -->
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--FIM GRID TABLE INDEX-->

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ this.obj.translate.table.bread }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" class="mb-0">
                    <div class="modal-body">
                        <form :id="getNameFormGrid()" :name="getNameFormGrid()" class="mt-1 fw-semibold" novalidate>
                            <div class="row">
                                <slot name="form"></slot>
                            </div>
                        </form>
                        <span class="fs-7 fst-italic fw-semibold">(*)  Campos obrigatórios</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal" @click="cancelarGrid()">{{ obj.global.button_cancel }}</button>
                        <button type="button" class="btn btn-success fw-semibold" @click="salvarGrid()">{{ obj.global.button_save }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: [
        "obj",
        "json",
        "lista",
        "namemodal",
        "auth",
    ],
    data: function () {
        return {
            editModalOpen: true,
            buscaDesc: "",
            currentPage: 1,
            itensPorPagina: 30,
            isLoading: false,
            colunas: [],
            listagem: [],
            editando: null,
            dinamica: false,
            campos_dinamicos: [],
            usuario: null,
        };
    },
    mounted() {
        console.log(this.obj.urlbase);
        console.log(this.lista);
        if (this.json.colunas) {
            this.colunas = this.json.colunas;
        }
        if (this.json.campos){
            this.json.campos.forEach(e=> {
                if (e.type == "tag"){
                    this.campos_dinamicos.push(e.id);
                }
            });
        }
        this.listagem = this.lista;
    },
    computed: {
        displayedPages() {
            const visiblePages = 5; // Defina o número de páginas visíveis desejado
            const halfVisible = Math.floor(visiblePages / 2);

            let startPage = Math.max(1, this.currentPage - halfVisible);
            let endPage = Math.min(
                startPage + visiblePages - 1,
                this.totalPages
            );

            if (endPage - startPage + 1 < visiblePages) {
                startPage = Math.max(1, endPage - visiblePages + 1);
            }

            return Array.from(
                { length: endPage - startPage + 1 },
                (_, index) => startPage + index
            );
        },
        paginatedListagem() {
            if (this.buscaDesc) {
                return this.listagem.filter((item) => {
                    return Object.values(item).some(
                        (value) =>
                            value &&
                            value
                                .toString()
                                .toLowerCase()
                                .includes(this.buscaDesc.toLowerCase())
                    );
                });
            } else {
                const startIndex = (this.currentPage - 1) * this.itensPorPagina;
                const endIndex = startIndex + this.itensPorPagina;
                return this.listagem.slice(startIndex, endIndex);
            }
        },
        totalPages() {
            return Math.ceil(this.listagem.length / this.itensPorPagina);
        },
    },
    methods: {
        salvarGrid(){
            alert("SALVAR");
            // this.isLoading = true;
            // var form = $('#Form_'+this.obj.urlbase).serialize();            
            // var keys = Object.keys(this.json.campos);
            // for(var i=0; i<this.json.campos.length;i++){
            //     if ((this.json.campos[i] != "created_at") && (this.json.campos[i] != "updated_at") && (this.json.campos[i] != "password")){
            //         if (this.json.campos[i].type == "editor") {
            //             form = form +'&'+this.json.campos[i].id+'='+$("#"+this.json.campos[i].id+"").summernote('code');
            //         }
            //     }
            // }
            
            // axios.post('/'+this.obj.urlbase+'/add',form).then(res => {
            //     this.isLoading = false;
            //     var result = res.data;
            //     if (result.error == false){
            //         if (result.action == "I"){
            //             this.listagem.push(JSON.parse(result.item));
            //         }
            //         if (result.action == "U"){
            //             if (this.editando >= 0){
            //                 this.listagem.splice(this.editando, 1);
            //                 this.listagem.push(JSON.parse(result.item));
            //                 this.editando = null;
            //             }
            //         }
            //         $('#Form_'+this.obj.urlbase).each (function(){
            //             this.reset();
            //         });

            //         this.campos_dinamicos.forEach(e => {
            //             $('#'+e).importTags('');
            //         });
                    
            //         if (result.reload) {
            //             window.location.reload();
            //         } else {
            //             this.$swal({
            //                 title: 'Sucesso',
            //                 text: result.message,
            //                 icon: 'success'
            //             }).then(function(){
            //                 location.reload();
            //             });
            //         }
            //     } else {
            //         this.$swal({
            //             title: 'Erro ao Incluir Registro',
            //             html: result.message,
            //             icon: 'error'
            //         });
            //     }

            // }).catch(err => {
            //     this.isLoading = false;
            // });
        },
        cancelarGrid(){
            // this.editando = null;
            $('#Form_'+this.obj.urlbase).each (function(){
                this.reset();
            });
            $("#"+this.namemodal).modal('hide');
        },
        getNameFormGrid(){
            return "Form_"+this.obj.urlbase;
        },
        getValueColumnGrid(item, coluna,tp){
            var str = 'item.'+coluna.nome;
            // console.log(str);
            var ret = eval(str);//retorna os IDs que contem na grid, que são as FKs

            if(coluna.nome === "inss" || coluna.nome === "fgts" || coluna.nome === "valor"){
                ret = this.$options.filters.salario(ret);
            }

            if (tp == "N"){
                if (coluna.nome.includes("_id")){
                    //tagName só funciona com modal criado, pois necessita do <select>
                    var x = document.getElementById(coluna.nome).id;
                    //console.log(x);
                    if (x ){
                        var vl_sel = $('#'+coluna.nome+' :reduce="option=> option.'+ret+'"]').html();
                        console.log(coluna.nome);
                        if (vl_sel){
                            ret = vl_sel;
                        }
                    }
                }
                return ret; 
            } else {
                if (ret == "N"){
                    return "<span class=\"badge rounded-pill badge-light-danger me-1\">INATIVO</span>";
                } else {
                    return "<span class=\"badge rounded-pill badge-light-success me-1\">ATIVO</span>";
                }
            }
        },
        editarGrid(index, obj){
            this.editando = index;
            var keys = Object.keys(obj);

            for(var i=0; i<keys.length;i++){
                var _type = "";
                for (var h=0; h<this.json.campos.length;h++) {
                    if (this.json.campos[h].id == keys[i]) {
                        _type = this.json.campos[h].type;
                    }
                }
                
                if ((keys[i] != "created_at") && (keys[i] != "updated_at") && (keys[i] != "password")){
                    var vl = eval('obj.'+keys[i]);

                    //alert(vl)//yyyy-mm-dd;
                    if (document.getElementById(keys[i])) {
                        var x = document.getElementById(keys[i]).tagName;
                        if (x == "INPUT"){
                            var type = $('#'+keys[i]).attr('type');
                            // this.mascararCampos();
                            if(keys[i] === "inss" || keys[i] === "fgts" || keys[i] === "salario" || keys[i] === "valor"){
                                $('#salario').mask('9.999.999,99',{reverse:true});
                                $('#valor').mask('9.999.999,99',{reverse:true});
                                $('#fgts').mask('9.999.999,99',{reverse:true});
                                $('#inss').mask('9.999.999,99',{reverse:true});
                            }
                            var date = $('#'+keys[i]).hasClass('pickadate');
                            if (date){
                                vl = moment(vl).format('YYYY-MM-DD');
                                $('#'+keys[i]).val(vl);
                            } else if (type == "checkbox"){
                                if (vl == 'S'){
                                    $('#'+keys[i]).prop( "checked", true );
                                }
                            } else {
                                if (this.campos_dinamicos.indexOf(keys[i]) !== -1){
                                    $('#'+keys[i]).importTags('');
                                    if (vl) {
                                        var _str = vl.toString().split(',');
                                        for (var h=0; h<_str.length;h++){
                                            $('#'+keys[i]).addTag(_str[h]);
                                        }
                                    }
                                } else {
                                    $('#'+keys[i]).val(vl);
                                }
                            }
                        } else if (x == "SELECT"){
                            $('#'+keys[i]+' option[value="'+vl+'"]').prop("selected", "selected");
                        } else if ((x == "TEXTAREA") && (_type == "editor")){
                            if (vl) {
                                $('#'+keys[i]).html(vl);
                                $('#'+keys[i]).summernote('code',vl);
                            }
                        } else {
                            $('#'+keys[i]).val(vl);
                        }
                    }
                    
                }    
            }
            
            this.campos_dinamicos.forEach( e => {
                var _str_field = e.toString();
                var e = jQuery.Event("keydown", { keyCode: 8 });
                $('#'+_str_field+"_tag").focus();
            });

            $("#"+this.namemodal).modal('show');

        },
        getColumNameGrid(name) {
            var str = eval("this.obj.translate." + name);
            return str;
        },
    },
};
</script>
