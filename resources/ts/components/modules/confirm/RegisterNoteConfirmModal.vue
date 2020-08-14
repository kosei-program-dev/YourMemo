<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="500">
      <v-card>
        <v-card-title class="headline">登録内容を確認してください。</v-card-title>

        <v-card-text class="d-flex flex-column">
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-account-circle</v-icon>
            タイトル:{{ registerNoteObj.title }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-email</v-icon>
            ひとことメモ:{{ registerNoteObj.comment }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-code-json</v-icon>
            URL:{{ registerNoteObj.url }}
          </v-chip>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex>
            <v-btn class="text-left" color="green darken-1" text @click="close">キャンセル</v-btn>
          </v-flex>

          <v-flex class="text-xs-right">
            <v-btn color="red darken-1" text @click="registerNote()">登録する</v-btn>
          </v-flex>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar v-model="snackbar" :timeout="timeout">{{ text }}</v-snackbar>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { ConfirmNoteObject } from "../../../vue-data-entity/ConfirmNoteObject";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import {
  NoteObject,
  NoteApiResponse
} from "../../../vue-data-entity/NoteObject";

@Component
export default class RegisterNoteConfirmModal extends Vue {
  dialog: boolean = false;

  snackbar: boolean = false;
  text: string = "登録が完了しました";
  timeout: number = 2000;

  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  @Prop()
  registerNoteObj!: ConfirmNoteObject;
  /**
   * name
   */
  public open() {
    this.dialog = true;
  }
  /**
   * name
   */
  public registerNote() {
    Vue.prototype.$http
      .post("/api/get/registerNote", { registerData: this.registerNoteObj })
      .then((res: AxiosResponse): void => {
        sessionStorage.setItem("snackbarText", "Noteの登録が完了しました。");
        location.reload();
      })
      .catch((error: AxiosError): void => {
        alert(
          "登録実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
        );
      });
  }

  public close() {
    this.dialog = false;
  }
}
</script>
