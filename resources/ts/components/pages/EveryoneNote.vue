<template>
  <v-content>
    <h1>EveryoneNote Page</h1>
    <v-simple-table dense>
      <template v-slot:default>
        <thead>
          <tr>
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
                  <v-icon @click="delete(asd,fd)">mdi-delete</v-icon>
                </v-btn>
              </v-col>
            </td>
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
  pageLength: number = 15;
  page: boolean = true;
  public created() {
    console.log("Everyonestart");
    this.getNotes();
  }
  public getNotes() {
    Vue.prototype.$http
      .get("/api/get/everyoneNote")
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.notes = res.data.data;
      })
      .catch((error: AxiosError): void => {
        alert(
          "検索実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
        );
      });
  }
}
</script>
