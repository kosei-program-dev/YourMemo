<template>
    <v-content>
        <h1>わたしのメモ</h1>
        <ValidationObserver ref="observer">
            <v-row>
                <v-col cols="10">
                    <ValidationProvider
                        v-slot="{ errors }"
                        name="検索単語"
                        rules="required|max:100"
                    >
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
                        <td style="white-space:pre-wrap; word-wrap:break-word;">
                            {{ item.url }}
                        </td>
                        <td>
                            {{
                                new Date(item.created_at).toLocaleString(
                                    "ja-JP-u-ca-japanese"
                                )
                            }}
                        </td>
                        <td>
                            <v-icon small color="blue">mdi-star</v-icon>
                            ({{ item.evaluation }})
                        </td>
                        <td>
                            <v-col cols="12" sm="3">
                                <v-btn icon color="gray">
                                    <v-icon @click="updateNoteConfirm(item)"
                                        >mdi-cached</v-icon
                                    >
                                </v-btn>
                            </v-col>
                        </td>
                        <td>
                            <v-col cols="12" sm="3">
                                <v-btn icon color="gray">
                                    <v-icon @click="deleteNoteConfirm(item)"
                                        >mdi-delete</v-icon
                                    >
                                </v-btn>
                            </v-col>
                        </td>
                    </tr>
                </tbody>
            </template>
        </v-simple-table>
        <update-my-note-confirm-modal
            ref="updateDialog"
            :noteData="noteData"
            @snackbar="openSnackbar"
            :crudNoteObj="crudNoteObj"
        ></update-my-note-confirm-modal>
        <delete-my-note-confirm-modal
            ref="deleteDialog"
            @snackbar="openSnackbar"
            :crudNoteObj="crudNoteObj"
        ></delete-my-note-confirm-modal>
        <v-snackbar v-model="snackbar" :timeout="timeout">
            {{ snackbarText }}
        </v-snackbar>
    </v-content>
</template>

<script lang="ts">
import { Vue, Component, Watch } from "vue-property-decorator";
import { ValidationObserver } from "vee-validate";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";
import { ConfirmNoteObject } from "../../vue-data-entity/ConfirmNoteObject";
import DeleteMyNoteConfirmModal from "../modules/confirm/DeleteMyNoteConfirmModal.vue";
import UpdateMyNoteConfirmModal from "../modules/confirm/UpdateMyNoteConfirmModal.vue";

@Component({
    components: {
        DeleteMyNoteConfirmModal,
        UpdateMyNoteConfirmModal
    }
})
export default class MyNote extends Vue {
    public created() {
        this.getMyNotes();
    }
    searchWord: string | null = null;
    noteData: any = {};
    notes: Array<NoteObject> = [];

    snackbar: boolean = false;
    snackbarText: string = "";
    timeout: number = 3000;

    crudNoteObj: ConfirmNoteObject = {
        title: "",
        comment: "",
        url: ""
    };

    $refs!: {
        observer: InstanceType<typeof ValidationObserver>;
        updateDialog: UpdateMyNoteConfirmModal;
        deleteDialog: DeleteMyNoteConfirmModal;
    };

    @Watch("searchWord", { deep: true })
    public async search() {
        const isValid = await this.$refs.observer.validate();
        if (isValid) {
            Vue.prototype.$http
                .get("/api/get/searchMyNote", {
                    params: { searchWord: this.searchWord }
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
            this.getMyNotes();
        }
    }

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
    public openSnackbar(snackbarText: string) {
        this.snackbarText = snackbarText;
        this.snackbar = true;
        this.getMyNotes();
    }

    public async updateNoteConfirm(item: any) {
        this.noteData = item;
        this.crudNoteObj.title = item.title;
        this.crudNoteObj.comment = item.comment;
        this.crudNoteObj.url = item.url;
        this.$refs.updateDialog.open();
    }

    public async deleteNoteConfirm(item: any) {
        this.crudNoteObj = item;
        this.$refs.deleteDialog.open();
    }
}
</script>
