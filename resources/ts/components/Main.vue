<template>
  <v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app clipped>
      <v-list dense>
        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/myPage">MyPage</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/everyoneNote">EveryoneNote</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-table-heart</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/myNote">MyNote</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/">Home</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="!auth">
          <v-list-item-action>
            <v-icon>mdi-login</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/login">Login</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-bell-ring</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/notification">Notification</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="!auth">
          <v-list-item-action>
            <v-icon>mdi-note-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/register">Register</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-note-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/registerNote">RegisterNote</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-folder-search-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/search">Search</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list-item v-if="auth">
        <v-list-item-action>
          <v-icon>mdi-logout</v-icon>
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>
            <a class="black--text" @click="dialogOpen()">Logout</a>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-navigation-drawer>

    <v-app-bar app clipped-left color="blue darken-3 white--text">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>YourMemo ~あなたのメモ~</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-toolbar-title v-if="auth">{{auth.name}} さんでログインしています</v-toolbar-title>
    </v-app-bar>

    <router-view></router-view>

    <v-bottom-navigation v-model="bottomNav">
      <v-btn value="recent">
        <span>Recent</span>
        <v-icon>mdi-history</v-icon>
      </v-btn>

      <v-btn value="favorites">
        <span>Favorites</span>
        <v-icon>mdi-heart</v-icon>
      </v-btn>

      <v-btn value="nearby">
        <span>Nearby</span>
        <v-icon>mdi-map-marker</v-icon>
      </v-btn>
    </v-bottom-navigation>

    <v-footer app clipped-center color="blue darken-3 white--text">
      <span>&copy; Kosei's Project</span>
    </v-footer>
    <logout-confirm-modal ref="dialog"></logout-confirm-modal>
  </v-app>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import LogoutConfirmModal from "./modules/LogoutConfirmModal.vue";

@Component({
  components: {
    LogoutConfirmModal
  }
})
export default class App extends Vue {
  drawer: boolean = false;
  bottomNav: boolean = true;

  $refs!: {
    dialog: LogoutConfirmModal;
  };

  public async dialogOpen() {
    this.$refs.dialog.open();
  }
  private redirect() {}
  @Prop()
  auth!: any;

  @Prop()
  errors!: any;
}
</script>
