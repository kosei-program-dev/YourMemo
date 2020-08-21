<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="500">
      <v-card>
        <v-card-title class="headline">更新したい項目をクリックし、変更してください。</v-card-title>
        <v-col cols="12" md="12">
          <ValidationObserver ref="observer">
            <ValidationProvider v-slot="{ errors }" name="title" rules="required|max:100">
              <v-text-field
                prepend-icon="mdi-account-circle"
                v-model="crudNoteObj.title"
                name="title"
                :counter="100"
                :error-messages="errors"
                label="タイトル"
                required
              ></v-text-field>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="comment" rules="required|max:100">
              <v-text-field
                prepend-icon="mdi-email"
                v-model="crudNoteObj.comment"
                name="comment"
                :counter="100"
                :error-messages="errors"
                label="ひとことメモ"
                required
              ></v-text-field>
            </ValidationProvider>
            <ValidationProvider v-slot="{ errors }" name="url" rules="required|max:1000">
              <v-text-field
                prepend-icon="mdi-code-json"
                v-model="crudNoteObj.url"
                name="url"
                :counter="1000"
                :error-messages="errors"
                label="url"
                required
              ></v-text-field>
            </ValidationProvider>
          </ValidationObserver>
        </v-col>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-flex>
            <v-btn class="text-left" color="green darken-1" text @click="close()">キャンセル</v-btn>
          </v-flex>
          <v-flex class="text-xs-right">
            <v-btn color="red darken-1" text @click="updateNote()">更新する</v-btn>
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
import { ValidationObserver } from "vee-validate";

@Component
export default class UpdateMyNoteConfirmModal extends Vue {
  dialog: boolean = false;
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  @Prop()
  noteData!: any;
  @Prop()
  crudNoteObj!: ConfirmNoteObject;

  $refs!: {
    observer: InstanceType<typeof ValidationObserver>;
  };

  /**
   * name
   */
  public open() {
    this.dialog = true;
  }
  /**
   * name
   */
  public async updateNote() {
    const isValid = await this.$refs.observer.validate();
    if (isValid) {
      this.noteData.title = this.crudNoteObj.title;
      this.noteData.comment = this.crudNoteObj.comment;
      this.noteData.url = this.crudNoteObj.url;
      Vue.prototype.$http
        .post("/api/update/updateNote", { noteData: this.noteData })
        .then((res: AxiosResponse<NoteApiResponse>): void => {
          this.$emit("snackbar", "Noteの更新が完了しました");
          this.close();
        })
        .catch((error: AxiosError): void => {
          alert(
            "更新実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
          );
        });
    }
  }

  public close() {
    this.dialog = false;
  }
}
</script>
