<template>
    <div class="content-wrapper mt-3">
        <form>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Reporte Datos Trabajador</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-sm table-hover-animation table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="100%" colspan="2" scope="col" class="text-center">Tipo Reporte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdoespecifico" name="rdotipo" class="custom-control-input" value="1"/>
                                                        <label class="custom-control-label" for="rdoespecifico">Especifico</label>
                                                    </div>
                                                </td>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdobloque" name="rdotipo" class="custom-control-input" value="2"/>
                                                        <label class="custom-control-label" for="rdobloque">Bloque</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-sm table-hover-animation table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th width="100%" colspan="2" scope="col" class="text-center">Estado Trabajador</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdoactivo" name="rdoestado" class="custom-control-input" value="1"/>
                                                        <label class="custom-control-label" for="rdoactivo">Activo</label>
                                                    </div>
                                                </td>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rdocesado" name="rdoestado" class="custom-control-input" value="2"/>
                                                        <label class="custom-control-label" for="rdocesado">Cesado</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-8">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge form-label-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text form-control-sm"><i class="material-icons">person</i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" placeholder="NOMBRE" disabled/>
                                            <div class="input-group-prepend">
                                                <button data-backdrop="false" type="button" @click="traerDatosTrabajador" class="btn btn-sm btn-relief-primary btn-icon"><i class="material-icons BtnSm">search</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="input-group input-group-merge form-label-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text form-control-sm"><i class="material-icons">text_snippet</i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" placeholder="DNI" disabled/>
                                            <label for="dni"><b>DNI</b></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="row">
                                        <div class="col-6 offset-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbopciones" @click="marcarOpciones()" v-model="principal"/>
                                                <label class="custom-control-label" for="chbopciones">Todas las Opciones</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-1">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbpersonal" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbpersonal">Personal</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chblaboral" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chblaboral">Laboral</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbfamiliar" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbfamiliar">Familiar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbdirecciones" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbdirecciones">Direcciones</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbremuneracion" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbremuneracion">Remuneración</label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbcontratos" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbcontratos">Contratos</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 offset-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="chbinstruccion" v-model="form.chbopciones" />
                                                <label class="custom-control-label" for="chbinstruccion">Instrucción</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</template>

<script>

export default {
	name: "MO113ME4SM1ExportarForm",
    props:
    { 
        form: Object
    },
    data() {
        return {
            principal: false,
        };
    },
    methods: {
        traerDatosTrabajador: function() {
            
        },
        marcarOpciones: function() {
            console.log('data');
        }
    }
};

</script>