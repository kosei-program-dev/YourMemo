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
        <!-- <tbody>
          <tr v-for="item in teams" :key="item.id"></tr>
          <tr>
            <td>
              <v-icon @click="download(item.id)">mdi-cloud-download-outline</v-icon>
            </td>
            <td>{{ item.comment }}</td>
            <td style="white-space:pre-wrap; word-wrap:break-word;">{{ item.url }}</td>
            <td>{{ item.created_at }}</td>
            <td>{{ item.evaluation }}</td>
          </tr>
        </tbody>-->
      </template>
    </v-simple-table>
    <!-- <v-pagination v-model="page" :length="pageLength"></v-pagination> -->
  </v-content>
</template>

<script lang='ts'>
import { Vue, Component, Watch } from "vue-property-decorator";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";

@Component
export default class EveryoneNote extends Vue {
  events: Array<NoteObject>;
  public getEvents() {
    Vue.prototype.$http
      .get("/api/get/everyoneNote")
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.events = res.data.data;
        this.events.map(object => {
          return (
            (object.id = object.event_name),
            (object.comment = object.event_details),
            (object.previewImage = object.event_closing_day),
            (object.url = object.event_closing_day),
            (object.evaluation = object.event_closing_day)
          );
        });
      })
      .catch((error: AxiosError): void => {
        alert("検索実行時にエラーが発生しました");
      });
  }
}
</script>
