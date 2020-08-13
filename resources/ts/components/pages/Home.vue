<template>
  <v-content>
    <h1>Home Page</h1>
    <v-snackbar v-model="snackbar" :timeout="timeout">{{ text }}</v-snackbar>
  </v-content>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";
import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from "axios";
import { NoteObject, NoteApiResponse } from "../../vue-data-entity/NoteObject";
@Component
export default class RegisterNoteConfirmModal extends Vue {
  snackbar: boolean = false;
  text: string = "登録が完了しました";
  timeout: number = 2000;
}
</script>
