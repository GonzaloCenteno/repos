<template>
    <div class="content-wrapper mt-3">
        <form>
            <div class="content-body">
                <section id="card-actions">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Adicionales Trabajador</h4>
                                    <div v-if="$store.state.errors['trabajador.tthdatcage']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcage'][0] }}</div>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="material-icons">expand_more</i></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"><i class="material-icons">autorenew</i></a>
                                            </li>
                                            <li>
                                                <a data-action="close"><i class="material-icons">close</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge form-label-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text form-control-sm"><i class="material-icons">person</i></span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-sm" placeholder="NOMBRE" v-model="modal.nombre" disabled/>
                                                        <label for="nombre"><b>NOMBRE</b></label>
                                                        <div class="input-group-prepend">
                                                            <button data-backdrop="false" type="button" @click="traerDatosTrabajador" class="btn btn-sm btn-relief-primary btn-icon"><i class="material-icons BtnSm">search</i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-merge form-label-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text form-control-sm"><i class="material-icons">text_snippet</i></span>
                                                        </div>
                                                        <input type="text" class="form-control form-control-sm" placeholder="DNI" v-model="modal.dni" disabled/>
                                                        <label for="dni"><b>DNI</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-4">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="USUARIO" v-model="modal.usuario" disabled/>
                                                    <label for="usuario"><b>USUARIO</b></label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="COD. AGENDA" v-model="modal.codAgencia" disabled/>
                                                    <label for="codagencia"><b>COD. AGENCIA</b></label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="ESTADO" v-model="modal.estado" disabled/>
                                                    <label for="estado"><b>ESTADO</b></label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="PERFIL" v-model="modal.perfil" disabled/>
                                                    <label for="perfil"><b>PERFIL</b></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row pt-1">
                                            <div class="col-4">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="AGENCIA" v-model="modal.agencia" disabled/>
                                                    <label for="agencia"><b>AGENCIA</b></label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="FECHA INGRESO" v-model="modal.fechaIngreso" disabled/>
                                                    <label for="fechaingreso"><b>FECHA INGRESO</b></label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="FECHA REINGRESO" v-model="modal.fechaReingreso" disabled/>
                                                    <label for="fechareingreso"><b>FECHA REINGRESO</b></label>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" placeholder="FECHA CESE" v-model="modal.fechaCese" disabled/>
                                                    <label for="fechacese"><b>FECHA CESE</b></label>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Laborales</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="material-icons">expand_more</i></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"><i class="material-icons">autorenew</i></a>
                                            </li>
                                            <li>
                                                <a data-action="close"><i class="material-icons">close</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattcol" filterable placeholder="T. Colaborador">
                                                        <el-option v-for="colaborador in tthdattcol" :key="colaborador.tadconcorr" :label="colaborador.tadcondesc" :value="colaborador.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdattcol']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattcol'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattper" filterable placeholder="T. Personal">
                                                        <el-option v-for="personal in tthdattper" :key="personal.tadconcorr" :label="personal.tadcondesc" :value="personal.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdattper']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattper'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattcon" filterable placeholder="T. Contrato">
                                                        <el-option v-for="contrato in tthdattcon" :key="contrato.tadconcorr" :label="contrato.tadcondesc" :value="contrato.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdattcon']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattcon'][0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatgere" filterable placeholder="Gerencia">
                                                        <el-option v-for="gerencia in tthdatgere" :key="gerencia.tadconcorr" :label="gerencia.tadcondesc" :value="gerencia.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatgere']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatgere'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatdepa" filterable placeholder="Departamento">
                                                        <el-option v-for="departamento in tthdatdepa" :key="departamento.tadconcorr" :label="departamento.tadcondesc" :value="departamento.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatdepa']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatdepa'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdattare" filterable placeholder="Tipo de Area">
                                                        <el-option v-for="area in tthdattare" :key="area.tadconcorr" :label="area.tadcondesc" :value="area.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdattare']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdattare'][0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatgrup" filterable placeholder="Grupo">
                                                        <el-option v-for="grupo in tthdatgrup" :key="grupo.tadconcorr" :label="grupo.tadcondesc" :value="grupo.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatgrup']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatgrup'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatnive" filterable placeholder="Nivel">
                                                        <el-option v-for="nivel in tthdatnive" :key="nivel.tadconcorr" :label="nivel.tadcondesc" :value="nivel.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatnive']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatnive'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatcate" filterable placeholder="Categoria">
                                                        <el-option v-for="categoria in tthdatcate" :key="categoria.tadconcorr" :label="categoria.tadcondesc" :value="categoria.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatcate']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcate'][0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.trabajador.tthdatosbs" filterable placeholder="OFICINA SBS">
                                                        <el-option v-for="oficinasbs in tthdatosbs" :key="oficinasbs.tadsofcofi" :label="oficinasbs.tadsofnomb" :value="oficinasbs.tadsofcofi"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatosbs']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatosbs'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" :class="{ 'is-invalid' : $store.state.errors['trabajador.tthdatncar'] }" placeholder="NOMBRE DEL PUESTO" v-model="Formulario.trabajador.tthdatncar"/>
                                                    <label for="nombrepuesto"><b>NOMBRE DEL PUESTO</b></label>
                                                    <div v-if="$store.state.errors['trabajador.tthdatncar']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatncar'][0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Pensiones</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="material-icons">expand_more</i></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"><i class="material-icons">autorenew</i></a>
                                            </li>
                                            <li>
                                                <a data-action="close"><i class="material-icons">close</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" show-message="true" v-model="Formulario.trabajador.tthdatspen" filterable placeholder="SISTEMA DE PENSIONES">
                                                        <el-option v-for="pension in tthdatspen" :key="pension.tadconcorr" :label="pension.tadcondesc" :value="pension.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['trabajador.tthdatspen']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatspen'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-label-group">
                                                    <input type="text" class="form-control form-control-sm" :class="{ 'is-invalid' : $store.state.errors['trabajador.tthdatcusp'] }" placeholder="CUSPP" v-model="Formulario.trabajador.tthdatcusp"/>
                                                    <label for="cuspp"><b>CUSPP</b></label>
                                                    <div v-if="$store.state.errors['trabajador.tthdatcusp']" class="TextInvalid">{{ $store.state.errors['trabajador.tthdatcusp'][0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Remuneracíon</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="material-icons">expand_more</i></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"><i class="material-icons">autorenew</i></a>
                                            </li>
                                            <li>
                                                <a data-action="close"><i class="material-icons">close</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <el-select ref="cmbTipo" @change="tipoAbono($event)" class="SelectStyle" size="mini" v-model="Formulario.pago.tthpgptdes" filterable placeholder="TIPO">
                                                        <el-option v-for="pago in tthpgptdes" :key="pago.tadconcorr" :label="pago.tadcondesc" :value="pago.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['pago.tthpgptdes']" class="TextInvalid">{{ $store.state.errors['pago.tthpgptdes'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-4" v-loading="$store.state.inputloading">
                                                <div class="form-group">
                                                    <el-select @change="SeleccionarEntidad($event,$refs.cmbTipo)" class="SelectStyle" clearable v-model="Formulario.pago.tthpgpcent" size="mini" filterable placeholder="ENTIDAD">
                                                        <el-option v-for="entidad in tthpgpcent" :key="entidad.cbco" :label="entidad.nbco" :value="entidad.cbco"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['pago.tthpgpcent']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcent'][0] }}</div>
                                                </div>
                                            </div>
                                            <template v-if="flag">
                                                <div class="col-6" v-loading="$store.state.inputloading">
                                                    <div class="form-group">
                                                        <el-select class="SelectStyle" v-model="Formulario.pago.tthpgpcnta" size="mini" filterable placeholder="CUENTA AHORROS">
                                                            <el-option v-for="cuentahorro in cuentaAhorros" :key="cuentahorro.ncta" :label="cuentahorro.ncta" :value="cuentahorro.ncta"></el-option>
                                                        </el-select>
                                                        <div v-if="$store.state.errors['pago.tthpgpcnta']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcnta'][0] }}</div>
                                                    </div>
                                                </div>
                                            </template>
                                            <template v-if="!flag">
                                                <div class="col-3" v-loading="$store.state.inputloading">
                                                    <div class="form-label-group">
                                                        <input type="number" class="form-control form-control-sm" :class="{ 'is-invalid' : $store.state.errors['pago.tthpgpcnta'] }" placeholder="CNTA. AHORROS" v-model="Formulario.pago.tthpgpcnta"/>
                                                        <label for="cuentaahorros"><b>CNTA. AHORROS</b></label>
                                                        <div v-if="$store.state.errors['pago.tthpgpcnta']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcnta'][0] }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-label-group">
                                                        <input type="number" class="form-control form-control-sm" :class="{ 'is-invalid' : $store.state.errors['pago.tthpgpcnti'] }" placeholder="CNTA. AHORROS INTERBANCARIA" v-model="Formulario.pago.tthpgpcnti"/>
                                                        <label for="cuentainterbancaria"><b>CNTA. AHORROS INTERBANCARIA</b></label>
                                                        <div v-if="$store.state.errors['pago.tthpgpcnti']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpcnti'][0] }}</div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <el-select class="SelectStyle" size="mini" v-model="Formulario.pago.tthpgpfpag" filterable placeholder="FRECUENCIA DE PAGO">
                                                        <el-option v-for="formaspago in tthpgpfpag" :key="formaspago.tadconcorr" :label="formaspago.tadcondesc" :value="formaspago.tadconcorr"></el-option>
                                                    </el-select>
                                                    <div v-if="$store.state.errors['pago.tthpgpfpag']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpfpag'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-label-group">
                                                    <input type="number" class="form-control form-control-sm" :class="{ 'is-invalid' : $store.state.errors['pago.tthpgpsbas'] }" placeholder="SUELDO BASICO (S./)" v-model="Formulario.pago.tthpgpsbas"/>
                                                    <label for="sueldobasico"><b>SUELDO BASICO (S./)</b></label>
                                                    <div v-if="$store.state.errors['pago.tthpgpsbas']" class="TextInvalid">{{ $store.state.errors['pago.tthpgpsbas'][0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="custom-control custom-control-primary custom-switch">
                                                    <p class="mb-50">RENTA DE QUINTA</p>
                                                    <input type="checkbox" checked class="custom-control-input" id="customSwitch1" v-model="Formulario.pago.tthpgpr5ta"/>
                                                    <label class="custom-control-label" for="customSwitch1"></label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="custom-control custom-control-primary custom-switch">
                                                    <p class="mb-50">ASIG. FAMILIAR</p>
                                                    <input type="checkbox" checked class="custom-control-input" id="customSwitch2" v-model="Formulario.pago.tthpgpafam"/>
                                                    <label class="custom-control-label" for="customSwitch2"></label>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="custom-control custom-control-primary custom-switch">
                                                    <p class="mb-50">EPS</p>
                                                    <input type="checkbox" checked class="custom-control-input" id="customSwitch3" v-model="Formulario.pago.tthpgpseps"/>
                                                    <label class="custom-control-label" for="customSwitch3"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Bonos</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="collapse"><i class="material-icons">expand_more</i></a>
                                            </li>
                                            <li>
                                                <a data-action="reload"><i class="material-icons">autorenew</i></a>
                                            </li>
                                            <li>
                                                <a data-action="close"><i class="material-icons">close</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4 offset-2">
                                                <el-select ref="cmbBono" class="SelectStyle" size="mini" v-model="Formulario.bono" filterable placeholder="SELECCIONAR BONO">
                                                    <el-option v-for="bono in bonos" :key="bono.tadconcorr" :label="bono.tadcondesc" :value="bono.tadconcorr"></el-option>
                                                </el-select>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-label-group">
                                                    <input type="number" class="form-control form-control-sm" placeholder="BONO" v-model="Formulario.txtbono"/>
                                                    <label for="bono"><b>BONO</b></label>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <button type="button" @click="abonar($refs.cmbBono)" class="btn btn-sm btn-relief-primary btn-icon"><i class="material-icons BtnSm">add</i></button>
                                            </div>
                                            <div class="col-8 py-0 my-1 offset-2 text-center">
                                                <div v-if="$store.state.errors.bonos" class="TextInvalid">{{ $store.state.errors.bonos[0] }}</div>
                                                <table class="table table-sm table-hover-animation">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%" scope="col">#</th>
                                                            <th width="60%" scope="col">BONO</th>
                                                            <th width="20%" scope="col">MONTO</th>
                                                            <th width="10%" scope="col">ACCIONES</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(fila, index) in Formulario.bonos" :key="index">
                                                            <td class="py-0 my-0">{{ index + 1 }}</td>
                                                            <td class="py-0 my-0">{{ fila.texto }}</td>
                                                            <td class="py-0 my-0">{{ fila.tthbonmont }}</td>
                                                            <td class="py-0 my-0"><button type="button" @click="eliminarCelda(index)" class="btn btn-sm btn-relief-danger btn-icon"><i class="material-icons BtnSm">delete</i></button></td>
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
                </section>
            </div>
        </form>

        <div class="modal fade" :class="{ show: $store.state.showModal }" :style=" $store.state.showModal ? $store.state.mostrarModal : $store.state.ocultarModal ">
            <ModalGbage ref="datos" @llenarDatos="llenarDatos" @buscarTrabajador="buscarTrabajador" :datatable="datatable" :detalle="detalle" :cabecera="cabecera">
                <template #buttons>
                    <loading-button
                        :loading="$store.state.processing"
                        :icon="'search'"
                    >
                        Buscar
                    </loading-button>
                </template>
            </ModalGbage>
        </div>
    </div>
</template>

<script>

import LoadingButton from '../../../../Components/LoadingButton'
import ModalGbage from '../../../../Modals/MO113/ME1/SM3/ModalGbage'
export default {
    name: "TthdatForm",
    components: {
        ModalGbage,
        LoadingButton
    },
    props: {
        Formulario: Object,
        opciones: Array,
        modal: Object,
        oficinasbs: Array,
        datos: Object
    },
    data() {
        return {
            tthdattcol: [],
            tthdattper: [], 
            tthdattcon: [], 
            tthdatgere: [], 
            tthdatdepa: [],
            tthdattare: [],
            tthdatgrup: [], 
            tthdatnive: [], 
            tthdatcate: [], 
            tthdatspen: [], 
            tthpgptdes: [],
            tthpgpfpag: [],
            tthdatosbs: [],
            tthpgpcent: [],
            cuentaAhorros: [],
            bonos: [],
            flag: true,
            cabecera: ["COD AGENDA","NOMBRE","TIPO DOCUMENTO","NRO. DOCUMENTO",'ACCIONES'],
            detalle: [
                { data: 'gbagecage', searchable: false },
                { data: 'gbagenomb' },
                { data: 'gbagetdid', searchable: false },
                { data: 'gbagendid'},
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            datatable: {
                url: this.route('programa.show',0),
                data: {
                    tipo: 1,
                    parametros: this.datos
                }
            },
        }
    },
    created() {
        this.tthdattcol = this.opciones.filter(colaborador => colaborador.tadconpref == 8); 
        this.tthdattper = this.opciones.filter(personal => personal.tadconpref == 9); 
        this.tthdattcon = this.opciones.filter(contrato => contrato.tadconpref == 10); 
        this.tthdatgere = this.opciones.filter(gerencia => gerencia.tadconpref == 11); 
        this.tthdatdepa = this.opciones.filter(departamento => departamento.tadconpref == 12); 
        this.tthdattare = this.opciones.filter(area => area.tadconpref == 13); 
        this.tthdatgrup = this.opciones.filter(grupo => grupo.tadconpref == 14); 
        this.tthdatnive = this.opciones.filter(nivel => nivel.tadconpref == 15); 
        this.tthdatcate = this.opciones.filter(categoria => categoria.tadconpref == 16); 
        this.tthdatspen = this.opciones.filter(pension => pension.tadconpref == 17);
        this.tthpgptdes = this.opciones.filter(pago => pago.tadconpref == 18);
        this.tthpgpfpag = this.opciones.filter(formaspago => formaspago.tadconpref == 19);
        this.bonos = this.opciones.filter(bono => bono.tadconpref == 20);
        this.tthdatosbs = this.oficinasbs;
    },
    methods: {
        traerDatosTrabajador: function() {
            this.$refs.datos.crearTabla();
            this.$store.state.showModal = true;
        },
        llenarDatos: function(data) {
            let datos = JSON.parse(data);
            axios.get(this.route('programa.show',0), {
                params: {
                    valor: datos.gbagecage,
                    tipo: 4
                }
            })
            .then(rspta => {
                this.$store.state.showModal = false;
                this.Formulario.trabajador.tthdatcage = datos.gbagecage;
                this.modal.nombre = datos.gbagenomb;
                this.modal.nombre = datos.gbagenomb;
                this.modal.dni = datos.gbagendid;
                this.modal.usuario = datos.adusrusrn;
                this.modal.codAgencia = datos.gbagecage;
                this.modal.estado = (datos.adusrmrcb == 0) ? 'ACTIVO' : 'CESADO';
                this.modal.perfil = datos.adusrnomb;
                this.modal.agencia = datos.adagndesc;
                this.modal.fechaIngreso = rspta.data.fing;
                this.modal.fechaReingreso = rspta.data.frei;
                this.modal.fechaCese = rspta.data.fces;
            }); 
        },
        abonar: function(abono) { 
            if(this.Formulario.bono == null || this.Formulario.txtbono == '')
                return false;

            this.Formulario.bonos.push({ tthbonitem :this.Formulario.bono, texto: abono.selectedLabel, tthbonmont: this.Formulario.txtbono });
            this.Formulario.txtbono = '',
            this.Formulario.bono = null
        },
        eliminarCelda(row) {
            this.$delete(this.Formulario.bonos, row);
        },
        buscarTrabajador: function(busqueda) {
            this.datos.busqueda = busqueda;
            this.$refs.datos.crearTabla();
        },
        tipoAbono(evt) {
            let valor = (evt == 1) ? 8 : 9;
            this.Formulario.pago.tthpgpcent = null;
            this.cuentaAhorros = [];
            this.Formulario.pago.tthpgpcnta = null;
            this.$store.state.inputloading = true;
            axios.get(this.route('programa.show',0), {
                params: {
                    valor: valor,
                    tipo: 2
                }
            })
            .then(rspta => {
                this.tthpgpcent = rspta.data;
                this.flag = (evt == 1) ? true : false;
                this.$store.state.inputloading = false;
            }); 
        },
        SeleccionarEntidad(evt,tipo) {
            let age = evt;
            let tabon = tipo.selected.$options.propsData.value;
            if(age == 60406 && tabon == 1)
            {
                this.$store.state.inputloading = true;
                axios.get(this.route('programa.show',0), {
                    params: {
                        valor: (this.modal.codAgencia == '') ? 0 : this.modal.codAgencia,
                        tipo: 3
                    }
                })
                .then(rspta => {
                    this.cuentaAhorros = rspta.data;
                    this.$store.state.inputloading = false;
                }); 
            }
        }
    }
};
</script>