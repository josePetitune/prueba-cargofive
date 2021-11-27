<template>
    <div class="container" v-if="show">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <b-col lg="6" class="my-1">
                        <b-form-group
                            label="Filter"
                            label-for="filter-input"
                            label-cols-sm="3"
                            label-align-sm="right"
                            label-size="sm"
                            class="mb-0"
                        >
                            <b-input-group size="sm">
                                <b-form-input
                                    id="filter-input"
                                    v-model="filter"
                                    type="search"
                                    placeholder="Type to Search"
                                ></b-form-input>

                                <b-input-group-append>
                                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                </b-input-group-append>
                            </b-input-group>
                        </b-form-group>
                    </b-col>
                    <b-table 
                        id="my-rates"
                        sticky-header 
                        striped 
                        hover 
                        responsive 
                        :items="items"
                        :fields="fields" 
                        :busy="isBusy" 
                        class="mt-3" 
                        outlined
                        show-empty
                        :filter="filter"
                        :filter-included-fields="filterOn"
                        :per-page="perPage"
                        :current-page="currentPage"
                    >
                        <template #table-busy>
                            <div class="text-center text-danger my-2">
                                <b-spinner class="align-middle"></b-spinner>
                                <strong>Loading...</strong>
                            </div>
                        </template>
                        <template #empty="scope">
                          <div class="justify-content-md-center">
                            <h6>Lo sentimos la informacion que proporciono no genero registros que visualizar :(</h6>
                          </div>
                          
                        </template>
                        <template #emptyfiltered="scope">
                          <div class="justify-content-md-center">
                            <h6>Lo sentimos la busqueda que proporciono no genero registros que visualizar :(</h6>
                          </div>
                          
                        </template>
                    </b-table>
                    <b-pagination
                      v-model="currentPage"
                      :total-rows="rows"
                      :per-page="perPage"
                      aria-controls="my-rates"
                    ></b-pagination>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
    props: {
      items:{
        type: Array
      },
      show:{
        type: Boolean
      }
    },
    watch: { 
      	items: function(newVal, oldVal) { // watch it
          console.log('Prop changed: ', newVal, ' | was: ', oldVal)
          this.isBusy = !this.isBusy
        }
    },
    data () {
      return {
        isBusy: false,
        filter: null,
        filterOn: [],
        perPage: 10,
        currentPage: 1,
        fields: [
          {
            key: 'nombre',
            label: 'Nombre',
            sortable: true
          },
          {
            key: 'fecha',
            label: 'Fecha',
            sortable: true
          },
          {
            key: 'origin',
            label: 'Origen',
            sortable: true
          },
          {
            key: 'destination',
            label: 'Destino',
            sortable: true
          },
          {
            key: 'twenty',
            label: 'Tarifa 20',
            sortable: true
          },
          {
            key: 'forty',
            label: 'Tarifa 40',
            sortable: true
          },
          {
            key: 'fortyhc',
            label: 'Tarifa 40 HC',
            sortable: true
          },
          {
            key: 'currency',
            label: 'Moneda',
            sortable: true
          }
        ]
      }
    },
    computed: {
      rows() {
        return this.items.length
      }
    },
    created() {
      this.isBusy = !this.isBusy
    }

  }
</script>