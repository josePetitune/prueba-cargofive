<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <b-col lg="12" class="my-1">
                    <b-alert variant="success" show>¡Tambien disponible en version mobile! :)</b-alert>
                </b-col>
                <b-col lg="12" class="my-1">
                    <b-list-group>
                        <b-list-group-item href="#" class="flex-column align-items-start py-5"  v-for="item in items" :key="item.id">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-content-docs">{{item.title}}</h5>
                                    <small><b-img :src="item.img" alt="" class="icon-docs"/></small>
                                </div>
                                <p class="mb-1 text-content-docs">
                                    {{item.text}}
                                </p>
                                <small>{{item.description}}</small>
                        </b-list-group-item>
                    </b-list-group>
                </b-col>
            </div>
        </div>
    </div>
</template>
<script>
  export default {
    data () {
      return {
          items:[
              {
                id:1,
                img:'storage/logo-laravel.png',
                title:'Laravel 8.65',
                text:'Framework contenedor de prueba para CargoFive',
                description:'Creacion de migraciones, modelos, Controladores, Clases, Repositorios.'
              },
              {
                id:2,
                img:'storage/logo-bootstrap.png',
                title:'Bootstrap 4.6',
                text:'Framework front-end',
                description:'Utilizado para header, footer y contenedor base.'
              },
              {
                id:3,
                img:'storage/logo-vue.png',
                title:'Vue 2.6',
                text:'Framework progresivo de construccion de interfaces',
                description:'Utilizado para contenido base de la prueba (Front-end)'
              },
              {
                id:4,
                img:'storage/logo-laravel-mix.png',
                title:'laravel-mix 6.0',
                text:'Procesador de codigo',
                description:'Procesado de CSS y JavaScript, Vue, entre otras cosas'
              },
              {
                id:5,
                img:'storage/logo-bootstrap-vue.png',
                title:'Bootstrap-vue',
                text:'framework front-end para Vue con Bootstrap 2.21',
                description:'Utilizado para dar estilo al Front-end'
              },
              {
                id:6,
                img:'storage/logo-vue.png',
                title:'Vue-Resource 1.5',
                text:'Complemento para Vue.js, que puede iniciar solicitudes y procesar respuestas a través de XMLHttpRequest o JSONP',
                description:''
              },
              {
                id:7,
                img:'storage/logo-infyom.png',
                title:'Infyom 8.0',
                text:'creación de API y scaffold CRUD',
                description:'Migración, Modelo, Controlador, Repositorio '
              },
              {
                id:8,
                img:'storage/logo-Swagger.png',
                title:'Swagger dev-master',
                text:'framework de gestion de api',
                description:'documentacion de api /api/docs'
              }
          ]
      }
    }
  }
</script>