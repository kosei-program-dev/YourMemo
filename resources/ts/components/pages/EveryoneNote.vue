<template>
  <v-content>
    <h1>EveryoneNote Page</h1>
    <v-simple-table dense>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-left">番号</th>
            <th class="text-left">ひとことメモ</th>
            <th class="text-left">URL</th>
            <th class="text-left">アップロード日時</th>
            <th class="text-left">評価</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in notes" :key="index">
            <td>
              <v-icon @click="download(item.id)">mdi-cloud-download-outline</v-icon>
            </td>
            <td>{{ item.comment }}</td>
            <td style="white-space:pre-wrap; word-wrap:break-word;">{{ item.url }}</td>
            <td>{{ item.created_at }}</td>
            <td>{{ item.evaluation }}</td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <!-- <v-pagination v-model="page" :length="pageLength"></v-pagination> -->
  </v-content>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";

@Component
export default class EveryoneNote extends Vue {
  notes: Array<NoteObject> = [];
  //   items: Array<NoteObject> = [];
  public created() {
    console.log("result");
    this.getNotes();
  }
  public getNotes() {
    Vue.prototype.$http
      .get("/api/get/everyoneNote")
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.notes = res.data.data;
        console.log(this.notes);
      })
      .catch((error: AxiosError): void => {
        alert("検索実行時にエラーが発生しました");
      });
  }
}
</script>
