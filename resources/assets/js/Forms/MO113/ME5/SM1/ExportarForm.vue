<template>
    <div class="content-wrapper mt-3">
        <form>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Descuentos Créditos Internos</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
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
                                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" value="1" v-model="form.radio"/>
                                                        <label class="custom-control-label" for="customRadio1">Detallado</label>
                                                    </div>
                                                </td>
                                                <td class="py-0 my-0">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" value="2" v-model="form.radio"/>
                                                        <label class="custom-control-label" for="customRadio2">Resumido</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
	name: "MO113ME5SM1ExportarForm",
    props:
    { 
        form: Object
    }
};

</script>