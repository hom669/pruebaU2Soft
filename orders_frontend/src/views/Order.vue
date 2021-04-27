<template>
<div>
       <v-navigation-drawer
    app
    clipped
    permanent
    expand-on-hover
  >
    <v-list>
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/1.jpg"></v-img>
        </v-list-item-avatar>
      </v-list-item>

      <v-list-item link>
        <v-list-item-content>
          <v-list-item-title class="title">{{user.name}}</v-list-item-title>
          <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

      <v-list
        nav
        dense
      >
        <v-list-item v-for="(item, i) in items" :key="i" :to="item.link" link>
          <v-list-item-icon>
            <v-icon>{{item.icon}}</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{item.text}}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <br>
    
    <v-card class="mx-auto mt-5" max-width="900" md>
      <v-card-title>Listado de Pedidos</v-card-title>
        <v-data-table
          :headers="columns"
          :items="dataorders"
          class="elevation-19"
          >
          <template>
            <v-system-bar color="indigo darken-2"></v-system-bar>
            <v-toolbar  color="indigo">
              <v-icon dark>mdi_plus</v-icon>
            </v-toolbar>
          </template>
         
        </v-data-table>
    </v-card>
        

  </div>
  
</template>

<script>
export default {
  
  data: () => ({
    user: { token: "", email: "", id: "", name: "" },
    columns: [
      {text:'Id de Envio', value:'id_order',class:"teal lighten-2 white--text"},
      {text:'Solicitante', value:'applicant',class:"teal lighten-2 white--text"},
      {text:'Fecha de Orden', value:'date_order',class:"teal lighten-2 white--text"},
      {text:'Fecha de Envio', value:'date_delivery',class:"teal lighten-2 white--text"},
         ],
    dataorders:[
      
    ],
    items: [
      {
        icon: 'mdi-folder',
        text: 'Pedidos Actuales',
        link: '/orders',
      },
      {
        icon: 'mdi-account-multiple',
        text: 'Consulta Por Fecha',
        link: '/orders-date',
      },
      {
        icon: 'mdi-star',
        text: 'Consulta Por Id',
        link: '/orders-id',
      },
      {
        icon: 'mdi-star',
        text: 'Salir',
        link: '/exit',
      },
    ],
    
  }),
  created: function () {
    this.user = JSON.parse(sessionStorage.getItem("session"));
    if (this.user == null) {
      this.$router.push("/");
    }
    
    this.axios.get('/getOrders').then(response => {
      this.dataorders = response.data;
      console.log(this.dataorders);
    });
  },
  
};
</script>
