<template>
  <div>
    <v-navigation-drawer app clipped permanent expand-on-hover>
      <v-list>
        <v-list-item class="px-2">
          <v-list-item-avatar>
            <v-img src="https://randomuser.me/api/portraits/men/1.jpg"></v-img>
          </v-list-item-avatar>
        </v-list-item>

        <v-list-item link>
          <v-list-item-content>
            <v-list-item-title class="title">{{ user.name }}</v-list-item-title>
            <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider></v-divider>

      <v-list nav dense>
        <v-list-item v-for="(item, i) in items" :key="i" :to="item.link" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{ item.text }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <br />

    <v-card class="mx-auto mt-5" max-width="900">
      <v-card-title> Consulta Pedidos Por Fecha </v-card-title>
      <v-card-text>
        <v-form class="ma-3" @submit.prevent="consultdate()" ref="dateform"> 
        <v-row>
          <v-col cols="12" sm="6" md="4">
            <v-menu
              ref="menu"
              v-model="menu"
              :close-on-content-click="false"
              :return-value.sync="date"
              transition="scale-transition"
              offset-y
              min-width="auto"
            >
              <template v-slot:activator="{ on, attrs }">
                <v-text-field
                  v-model="date"
                  label="Fecha de Pedido"
                  prepend-icon="today"
                  readonly
                  v-bind="attrs"
                  v-on="on"
                ></v-text-field>
              </template>
              <v-date-picker v-model="date" no-title scrollable>
                <v-spacer></v-spacer>
                <v-btn text color="primary" @click="menu = false">
                  Cancel
                </v-btn>
                <v-btn text color="primary" @click="$refs.menu.save(date)">
                  OK
                </v-btn>
              </v-date-picker>
            </v-menu>
          </v-col>

          <v-spacer></v-spacer>

          <v-btn block class="success" type="submit"> Consultar </v-btn>
        </v-row>
        </v-form>
      </v-card-text>

    </v-card>
  <div v-if="suForm">
    
    <v-card class="mx-auto mt-5" max-width="900">
      <v-card-title>Listado de Pedidos Por Fecha</v-card-title>
      <v-data-table :headers="columns" :items="dataorders" class="elevation-19">
      </v-data-table>
    </v-card>
  </div>
    
  </div>
</template>

<script>
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
    suForm: false,
    user: { token: "", email: "", id: "", name: "" },
    columns: [
      {
        text: "Id de Envio",
        value: "id_order",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Solicitante",
        value: "applicant",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Fecha de Orden",
        value: "date_order",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Fecha de Envio",
        value: "date_delivery",
        class: "teal lighten-2 white--text",
      },
    ],
    dataorders: [],
    items: [
      {
        icon: "mdi-folder",
        text: "Pedidos Actuales",
        link: "/orders",
      },
      {
        icon: "mdi-account-multiple",
        text: "Consulta Por Fecha",
        link: "/orders-date",
      },
      {
        icon: "mdi-star",
        text: "Consulta Por Id",
        link: "/orders-id",
      },
    ],
  }),
  
  created: function () {
    this.user = JSON.parse(sessionStorage.getItem("session"));
    if (this.user == null) {
      this.$router.push("/");
    }

  },

  methods: {
        async consultdate(){
           let date_send = {'date': this.date};
           if(date_send){
               try {
                   const res = await this.axios.post('/getOrdersDate',date_send)
                   console.log(res.data.message);
                   if(res.data.message!=undefined){
                     console.log("MAAL");
                      this.dataorders = [];
                      this.$refs.dateform.reset();
                      this.suForm = true;
                   }else{
                     console.log("NO MAAL");
                      this.dataorders = res.data;
                      this.$refs.dateform.reset();
                      this.suForm = true;
                   }
                  
                   

                   
               } catch (error) {
                 return "Error Connect API";
               }
           }
        },
  }

  
};
</script>
