<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="500">
      <v-card>
        <v-card-title class="headline">削除内容を確認してください。</v-card-title>

        <v-card-text class="d-flex flex-column">
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-account-circle</v-icon>
            タイトル:{{ crudNoteObj.title }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-email</v-icon>
            ひとことメモ:{{ crudNoteObj.comment }}
          </v-chip>
          <v-chip class="ma-2" color="blue" label text-color="white" cols="12" md="12">
            <v-icon left>mdi-code-json</v-icon>
            URL:{{ crudNoteObj.url }}
          </v-chip>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex>
            <v-btn class="text-left" color="green darken-1" text @click="close()">キャンセル</v-btn>
          </v-flex>
          <v-flex class="text-xs-right">
            <v-btn color="red darken-1" text @click="deleteNote(crudNoteObj)">削除する</v-btn>
          </v-flex>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { ConfirmNoteObject } from "../../../vue-data-entity/ConfirmNoteObject";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import {
  NoteObject,
  NoteApiResponse,
} from "../../../vue-data-entity/NoteObject";

@Component
export default class DeleteMyNoteConfirmModal extends Vue {
  dialog: boolean = false;
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  @Prop()
  crudNoteObj!: ConfirmNoteObject;
  /**
   * name
   */
  public open() {
    this.dialog = true;
  }
  /**
   * name
   */
  public deleteNote($noteData: object) {
    Vue.prototype.$http
      .post("/api/delete/deleteNote", { noteData: $noteData })
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.$emit("snackbar", "Noteの削除が完了しました");
        this.close();
      })
      .catch((error: AxiosError): void => {
        alert(
          "削除実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
        );
      });
  }

  public close() {
    this.dialog = false;
  }
}
</script>
