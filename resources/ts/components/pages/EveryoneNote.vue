<template>
  <v-content>
    <h1>みんなのメモ</h1>
    <v-container>
      <ValidationObserver ref="observer">
        <v-row>
          <v-col cols="10">
            <ValidationProvider v-slot="{ errors }" name="検索単語" rules="required|max:100">
              <v-text-field
                prepend-icon="mdi-folder-search-outline"
                v-model="searchWord"
                name="searchWord"
                :counter="100"
                :error-messages="errors"
                label="任意の単語で検索出来ます"
                required
              ></v-text-field>
            </ValidationProvider>
          </v-col>
        </v-row>
      </ValidationObserver>
    </v-container>
    <v-simple-table dense>
      <template v-slot:default>
        <thead>
          <tr>
            <th class="text-center">お気に入り</th>
            <th class="text-center">番号</th>
            <th class="text-center">タイトル</th>
            <th class="text-center">ひとことメモ</th>
            <th class="text-center">URL</th>
            <th class="text-center">アップロード日時</th>
            <th class="text-center">評価</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in notes" :key="index">
            <td class="text-center">
              <v-btn icon :color="jadgeFavorite(item.favorite_notes[0])">
                <v-icon @click="switchFavorite(item)">mdi-heart</v-icon>
              </v-btn>
            </td>
            <td>{{ index + 1 }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.comment }}</td>
            <td style="white-space:pre-wrap; word-wrap:break-word;">{{ item.url }}</td>
            <td>
              {{
              new Date(item.created_at).toLocaleString(
              "ja-JP-u-ca-japanese"
              )
              }}
            </td>
            <td>
              <v-icon color="blue">mdi-star</v-icon>
              ({{
              item.evaluation
              }})
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <v-snackbar v-model="snackbar" :timeout="1000">{{ snackbarText }}</v-snackbar>
  </v-content>
</template>

<script lang="ts">
import { Vue, Component, Watch } from "vue-property-decorator";
import { ValidationObserver } from "vee-validate";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";

@Component
export default class EveryoneNote extends Vue {
  notes: Array<NoteObject> = [];
  pageLength: number = 15;
  page: boolean = true;
  searchWord: string | null = null;

  snackbar: boolean = false;
  snackbarText: string = "";

  public created() {
    this.getNotes();
  }

  $refs!: {
    observer: InstanceType<typeof ValidationObserver>;
  };

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

  @Watch("searchWord", { deep: true })
  public async search() {
    const isValid = await this.$refs.observer.validate();
    if (isValid) {
      Vue.prototype.$http
        .get("/api/get/searchNote", {
          params: { searchWord: this.searchWord },
        })
        .then((res: AxiosResponse<NoteApiResponse>): void => {
          this.notes = res.data.data;
        })
        .catch((error: AxiosError): void => {
          alert(
            "検索実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
          );
        });
    } else {
      this.getNotes();
    }
  }

  public switchFavorite(data: any) {
    Vue.prototype.$http
      .post("/api/post/switchFavorite", { data: data })
      .then((res: AxiosResponse<NoteApiResponse>): void => {
        this.snackbarText = "お気に入り変更しました。";
        this.getNotes();
        this.snackbar = true;
      })
      .catch((error: AxiosError): void => {
        alert(
          "お気に入り機能実行時にエラーが発生しました。時間をおいて再度の試みをお願いいたします。"
        );
      });
  }

  public jadgeFavorite(relation: any) {
    if (relation) {
      return "red";
    } else {
      return "gray";
    }
  }
}
</script>
