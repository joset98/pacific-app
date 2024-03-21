<template>
  <div class="px-4 pt-2 mb-2">
    <h4 class="c-grey-900 mT-10 mb-3">Usuarios</h4>
    
    <mc-users :title="titleModal" :currentUser="currentUser" v-model="showModal" @refresh="refreshData"/>
    
    <delete-modal :jsonData="jsonData" v-model="showDeleteModal" >
      
      <div slot="content">
        ¿Se encuentra seguro que desea eliminar el usuario {{currentUser.name}}?
      </div>

      <div slot="footer">
        <button @click="showDeleteModal = false" class="btn btn-secondary">
            Cancelar
        </button>
        <button @click="actionDelete" class="btn btn-danger">
            <i class="ti-trash"></i>
            Eliminar
        </button>
      </div>
    </delete-modal>

    <div class="row">
      <div ref="users" class="col-md-12">
        <at-general
          title="Lista de usuarios"
          classHead="bg-dark"
          rounded="4px"
          striped
          :titles="usersTitles"
          :rows="usersRows"
          v-model="users.items"
        >
        <!-- head -->
          <template v-slot:head>
            <div class="d-flex justify-content-between mB-20">
              <h4 class="c-grey-900 mT-10">Lista de usuarios</h4>
              <div class="peer mT-10">
                <a @click="openModal({})" class="btn btn-primary">
                  <span class="icon-holder">
                    <i class="ti-pencil"></i>
                  </span>
                  Nuevo Usuario
                </a>
              </div>
            </div>
          </template>
        <!-- head -->
        <!-- Action -->
          <template v-slot:actions="props">
            <!-- <div class="d-flex align-items-center justify-content-start"> -->
              <div class="p-0 btn-table">
                <button @click="openModal(props.item)" class="btn btn-outline-primary">
                  <span class="icon-holder">
                  <i class="ti-pencil"></i>
                  </span>
                  Editar
                </button>
              </div>

              <div class="p-0">
                <button class="btn btn-outline-danger mX-1 mY-1" @click="openDeleteModal(props.item)">
                  <span class="icon-holder">
                  <i class="ti-trash"></i>
                  </span>
                    Eliminar
                </button>
              </div>
            <!-- </div> -->

          </template>
        <!-- Action -->
        
          <template v-slot:footer :position="start">
              <paginator v-model="page" :paginator="users" position="end"/>
          </template>
        </at-general>

      </div>
    </div>
  </div>
</template>

<script>
import { AtGeneral } from '../components/tables';
import paginator from '../components/paginator/paginator.vue';
import { mcUsers, deleteModal } from '../components/modals';

export default {
  name: 'users',
  components:{ AtGeneral, paginator, mcUsers, deleteModal },
  data(){
    return{
      titleModal: 'Titulo Default',
      currentUser: {},
      showModal: false,
      showDeleteModal: false,
      mpUsers: this.$mpage.index(5),
      page: 1,
      filter: null,
      // para deleteModal
      jsonData:{
        dataEmit: false,
        title: 'Eliminar Usuario',
        icon: {
          name: 'report_problem',
          style:{
            color: 'red'
          }
        },
      }
    }
  },
  methods:{

    async getUsers(){
      this.$loader.containe(this.$refs.users);
      console.log('testing')
      console.log(this.mpUsers.params('users', this.page))
      
        let request = await this.$store.dispatch('users/getUsers', this.mpUsers.params('users', this.page));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0) this.users = request.data;
    },

    async actionDelete(){
      //Estableciendo Usuario seleccionado 
      if( !this.currentUser ) return ;
      console.log(this.currentUser)
      //# Creando mi formData
      let data = this.$toFormData.transform(this.currentUser)
      this.$loader.full();
      const request = await this.$store.dispatch('users/deleteItem', data);
      this.$loader.hide();

      if(!request.ok) 
      {
        const {title, type, text} = this.$requestToNotification.transformRequest(request)
        this.$actionNotify.showNotification(type, title, text)
        return this.$allErrors.getError(request.data);
      }

      this.refreshData(this.currentUser);
      
      this.showDeleteModal = false;
    },

    async openDeleteModal(user = null){
      //Estableciendo Usuario seleccionado 
      this.currentUser = user; 
      //Habilitando el modal 
      this.showDeleteModal = true;
    },

    async openModal(user = null){
      //Titulo por defecto del modal 
      this.titleModal =  (user && user.id) ? 'Editar usuario':'Creacion de nuevo usuario'
      //Estableciendo proveedor seleccionado 
      this.currentUser = user; 
      //Habilitando el modal 
      this.showModal = true;
    },

    async refreshData(user = false){
      this.$loader.dinamic();
        let request = await this.$store.dispatch('users/getUsers', this.mpUsers.resetParams('users'));
      this.$loader.hide();

      if(request.ok && request.data.items && request.data.items.length > 0){
        if(user) this.mpUsers.remove('users', user, 'id');
        this.users = request.data;
      }
    }
  },
  computed:{
    usersTitles(){ return ['Nombre', 'Usuario', 'Correo', 'Fecha de creación',''] },
    usersRows(){
      return [
        {value: 'name',   classList: '', style: ''},
        {value: 'username',   classList: '', style: ''},
        {value: 'email',      classList: '', style: ''},
        {value: 'created_at', classList: '', style: ''/*, typeBoolean:[{classList:'caseTrue', label: 'Activo'}, {classList:'caseFalse', label: 'Desactivo'}]*/ },
        {value: 'actions',      classList: '', slot: true}

      ]
    },
    users:{
      get(){
        console.log('pasando de pagina')
        let paginator = this.mpUsers.get('users', this.page, null);
        if(paginator.items.length == 0) this.getUsers();

        return paginator;
      },
      set(value){ this.mpUsers.save('users', value, 'id') }
    }
  },
}
</script>

<style media="screen">
  .caseTrue{
    color: green;
  }
  .caseFalse{
    color: red;
  }
</style>
