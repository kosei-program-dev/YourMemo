<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="500">
      <v-card>
        <v-card-title class="headline">本当にログアウトして大丈夫ですか？</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex>
            <v-btn class="text-left" color="green darken-1" text @click="close">キャンセル</v-btn>
          </v-flex>

          <v-flex class="text-xs-right">
            <v-btn color="red darken-1" text @click="submit()">ログアウト</v-btn>
          </v-flex>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- <v-form method="POST" action="/logout" id="logout"></v-form> -->
    <v-form method="POST" action="/logout" id="logout">
      <input type="hidden" name="_token" :value="csrf" />
    </v-form>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";

@Component
export default class LogoutConfirmModal extends Vue {
  dialog: boolean = false;
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  /**
   * name
   */
  public open() {
    this.dialog = true;
  }
  /**
   * name
   */
  public submit() {
    (<HTMLFormElement>document.querySelector("#logout")).submit();
  }

  /**
   * name
   */
  public close() {
    this.dialog = false;
  }
}
</script>
