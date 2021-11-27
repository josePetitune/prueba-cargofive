<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Introduzca los datos del contrato y las rutas  
                    </div>
                    <div class="card-body">
                        <b-form @submit.prevent="onSubmitValidate">
                            <b-container>
                                <b-row>
                                    <b-col cols="12" md="12" class="mb-2">
                                        <b-form-group description="Nombre">
                                            <b-form-input
                                                v-model="data.nombre"
                                                label="Nombre"
                                                placeholder="Inserte el Nombre aqui" 
                                                required
                                            ></b-form-input>
                                        </b-form-group>
                                    </b-col>

                                    <b-col cols="12" md="12" class="mb-2">
                                        <b-form-group description="Fecha">
                                            <input type="date"
                                                class="form-control"
                                                label="Fecha"
                                                placeholder="Inserte la Fecha aqui" 
                                                v-model="data.fecha"
                                                required
                                            >
                                        </b-form-group>
                                    </b-col>
                                    <b-col class="mb-4 col-md-12 col-12">
                                        <span>El archivo excel a ingresar debe cumplir por lo menos con el siguiente estandar:</span>
                                        <b-img :src="img" alt="" style="width:100%"/>
                                    </b-col>
                                    <b-col cols="12" md="12" class="mb-2">
                                        <b-form-group description="Advertencia: Solo son permitidos archivos excel">
                                            <b-form-file
                                                type="file"
                                                placeholder="Inserte el archivo aqui" 
                                                drop-placeholder="Arrastra archivo aqui..."
                                                ref="file"
                                                v-model="file"
                                                id="file"
                                                :state="Boolean(file)"
                                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                            ></b-form-file>
                                        </b-form-group>
                                    </b-col>
                                    <b-col cols="12" md="12">
                                        <b-alert v-model="showDismissibleAlertSuccess" variant="success" dismissible>{{messageFile}}</b-alert>
                                        <b-alert v-model="showDismissibleAlert" variant="danger" dismissible>{{messageFile}}</b-alert>
                                        <b-button type="submit" class="btn-form">Guardar</b-button>
                                    </b-col>
                                </b-row>
                            </b-container>
                        </b-form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <table-component :historico="false" :items="items" :show="show"></table-component>
        </div>
    </div>
</template>

<script>
    import TableComponent from './TableComponent'
    export default {
        components: { TableComponent },
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                data:{
                    nombre:'',
                    fecha:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                },
                file:null,
                validformats:[
                    ".csv",
                    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                    "application/vnd.ms-excel"
                ],
                showDismissibleAlert: false,
                showDismissibleAlertSuccess: false,
                messageFile:'',
                img:'storage/header-excel.png',
                show:false,
                items:[]
            }
        },
        methods: {
            async onSubmitValidate() {
                var url = 'api/contracts'
                
                let formData = new FormData()
                formData.append('nombre', this.data.nombre)
                formData.append('fecha', this.data.fecha)
                formData.append('_token', this.csrf)
                
                let validation = this.validateFormat(this.$refs.file.files[0].type)
                
                if(validation == true){

                    this.messageFile = "El archivo es valido"
                    if($(this.$refs.file.files[0]) !== undefined){
                        formData.append('file', this.$refs.file.files[0])
                    }
                    this.show = !this.show
                    await axios.post(url , formData)
                    .then((response)=>{
                        this.messageFile = 'Hemos registrado la informacion correctamente'
                        this.showDismissibleAlert=false
                        this.showDismissibleAlertSuccess= true
                        this.items = response.data.data
                        this.show = true
                    }).catch(error => {
                        this.showDismissibleAlert=true
                        this.showDismissibleAlertSuccess= false
                        this.show = !this.show
                        this.messageFile = 'Lo sentimos, parece que ocurrio un error de comunicacion o puede que el formato del excel no cumple con el estandar solicitado :('
                    });

                }else{
                    this.messageFile = "El archivo es invalido, por favor introduce un archivo valido con formato .csv, .xlsx, .xls"
                }
            },
            validateFormat(type){
                if(this.validformats.indexOf(type) == -1){
                    this.showDismissibleAlert=true
                    this.showDismissibleAlertSuccess= false
                    return false
                } else{
                    this.showDismissibleAlert=false
                    this.showDismissibleAlertSuccess= true
                    return true
                }
            }
        }
    }
</script>
