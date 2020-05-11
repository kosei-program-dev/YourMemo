<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="500">
      <v-card>
        <v-card-title class="headline">登録内容を確認してください。</v-card-title>

        <v-card-text class="d-flex flex-column">
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-account-circle</v-icon>
            氏名:{{ registerObj.name }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-email</v-icon>
            Eメール:{{ registerObj.email }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-lock</v-icon>パスワード: セキュリティ保護のため非表示
          </v-chip>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex>
            <v-btn class="text-left" color="green darken-1" text @click="close">キャンセル</v-btn>
          </v-flex>

          <v-flex class="text-xs-right">
            <v-btn color="red darken-1" text @click="submit()">登録する</v-btn>
          </v-flex>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- <v-form method="POST" action="/logout" id="logout"></v-form>
    <v-form method="POST" action="/register" id="register">
      <input type="hidden" name="_token" :value="csrf" />
    </v-form>-->
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { RegisterObject } from "../../../vue-data-entity/RegisterObject";

@Component
export default class RegisterConfirmModal extends Vue {
  dialog: boolean = false;
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  @Prop()
  registerObj!: RegisterObject;

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
    (<HTMLFormElement>document.querySelector("#register")).submit();
  }

  /**
   * name
   */
  public close() {
    this.dialog = false;
  }
}
</script>
