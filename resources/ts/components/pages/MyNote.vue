<template>
  <v-content>
    <h1>MyNote Page</h1>
    <v-simple-table dense>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-center">番号</th>
            <th class="text-center">タイトル</th>
            <th class="text-center">ひとことメモ</th>
            <th class="text-center">URL</th>
            <th class="text-center">アップロード日時</th>
            <th class="text-center">評価</th>
            <th class="text-center">変更</th>
            <th class="text-center">削除</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in notes" :key="index">
            <td>{{ index + 1 }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.comment }}</td>
            <td style="white-space:pre-wrap; word-wrap:break-word;">{{ item.url }}</td>
            <td>{{ item.created_at }}</td>
            <td>{{ item.evaluation }}</td>
            <td>
              <v-col cols="12" sm="3">
                <v-btn icon color="gray">
                  <v-icon>mdi-cached</v-icon>
                </v-btn>
              </v-col>
            </td>
            <td>
              <v-col cols="12" sm="3">
                <v-btn icon color="gray">
                  <v-icon @click="deleteNoteConfirm(item)">mdi-delete</v-icon>
                </v-btn>
              </v-col>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <delete-my-note-confirm-modal ref="dialog" :deleteNoteObj="deleteNoteObj"></delete-my-note-confirm-modal>
  </v-content>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";
import { ConfirmNoteObject } from "../../vue-data-entity/ConfirmNoteObject";
import DeleteMyNoteConfirmModal from "../modules/confirm/DeleteMyNoteConfirmModal.vue";

@Component({
  components: {
    DeleteMyNoteConfirmModal
  }
})
export default class EveryoneNote extends Vue {
  public created() {
    this.getMyNotes();
  }

  notes: Array<NoteObject> = [];
  pageLength: number = 15;
  page: boolean = true;
  deleteNoteObj: ConfirmNoteObject = {
    title: "",
    comment: ""
  };

  $refs!: {
    dialog: DeleteMyNoteConfirmModal;
  };

  public getMyNotes() {
    Vue.prototype.$http
      .get("/api/get/myNote")
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.notes = res.data.data;
      })
      .catch((error: AxiosError): void => {
        alert(
          "検索実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
        );
      });
  }
  public async deleteNoteConfirm(item: any) {
    // this.deleteNoteObj.title = item.title;
    // this.deleteNoteObj.comment = item.title;
    this.deleteNoteObj = item;
    this.$refs.dialog.open();
  }
}
</script>
