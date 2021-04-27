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
      <v-card-title> Consulta Pedidos Por Id </v-card-title>
      <v-card-text>
        <v-form class="ma-3" @submit.prevent="consultid()" ref="idform">
          <v-row>
            <v-text-field
              label="Id Producto"
              prepend-icon="search"
              v-model="id"
            >
            </v-text-field>

            <v-spacer></v-spacer>

            <v-btn block class="success" type="submit"> Consultar </v-btn>
          </v-row>
        </v-form>
      </v-card-text>
    </v-card>
    <div v-if="suForm">
      <v-card class="mx-auto mt-5" max-width="900">
      <v-card-title> Listado de Pedidos Por Id </v-card-title>
        <v-data-table
          :headers="columns"
          :items="dataorders"
          class="elevation-19"
        >

        </v-data-table>
      </v-card>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    id: "",
    menu: false,
    modal: false,
    menu2: false,
    suForm: false,
    user: { token: "", email: "", id: "", name: "" },
    columns: [
      {
        text: "Nombre del Producto",
        value: "name_product",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Nombre del Vendedor",
        value: "name_vendor",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Cantidad Producto",
        value: "quantity",
        class: "teal lighten-2 white--text",
      },
      {
        text: "Cantidad Producto",
        value: "quantity_label",
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
    async consultid() {
      let id_send = { id_order: this.id };
      if (id_send) {
        try {
          const res = await this.axios.post("/getOrdersId", id_send);
          if (res.data.message != undefined) {
            this.dataorders = [];
            this.$refs.idform.reset();
            this.suForm = true;
          } else {
            this.dataorders = res.data;
            this.$refs.idform.reset();
            this.suForm = true;
          }
        } catch (error) {
          return "Error Connect API";
        }
      }
    },
    getStyle (quantity) {
    console.log(quantity);
      if (quantity == 0) return 'error'
      else return ''
    },
  },
};
</script>
