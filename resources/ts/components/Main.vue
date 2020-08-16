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
              <router-link class="black--text" to="/myPage">わたしのページ</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/everyoneNote">みんなのメモ</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-table-heart</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/myNote">わたしのメモ</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-home</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/">ホーム画面</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="!auth">
          <v-list-item-action>
            <v-icon>mdi-login</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/login">ログイン</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-bell-ring</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/notification">わたしへの通知</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="!auth">
          <v-list-item-action>
            <v-icon>mdi-note-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/register">ユーザ登録</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item v-if="auth">
          <v-list-item-action>
            <v-icon>mdi-note-plus</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/registerNote">ノート登録</router-link>
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-action>
            <v-icon>mdi-folder-search-outline</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>
              <router-link class="black--text" to="/search">メモ検索</router-link>
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
            <a class="black--text" @click="dialogOpen()">ログアウト</a>
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

    <router-view :auth="this.auth"></router-view>

    <v-footer app clipped-center color="blue darken-3 white--text">
      <span>&copy; Kosei's Project</span>
    </v-footer>
    <logout-confirm-modal ref="dialog"></logout-confirm-modal>
    <v-snackbar v-model="snackbar" :timeout="timeout">{{ snackbarText }}</v-snackbar>
  </v-app>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import LogoutConfirmModal from "./modules/confirm/LogoutConfirmModal.vue";

@Component({
  components: {
    LogoutConfirmModal,
  },
})
export default class App extends Vue {
  drawer: boolean = false;
  bottomNav: boolean = true;

  snackbar: boolean = false;
  snackbarText: string | null = sessionStorage.getItem("snackbarText");
  timeout: number = 3000;

  $refs!: {
    dialog: LogoutConfirmModal;
  };

  public created() {
    if (this.snackbarText) {
      this.snackbar = true;
      sessionStorage.removeItem("snackbarText");
    }
  }
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
