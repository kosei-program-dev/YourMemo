<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="500">
      <iframe :src="url" width="640" height="480" frameborder="0"></iframe>
    </v-dialog>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component } from "vue-property-decorator";

@Component
export default class PreviewModal extends Vue {
  dialog: boolean = false;
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");
  url: string | null = null;

  /**
   * name
   */
  public open($url: string) {
    this.url = $url;
    this.dialog = true;
  }
  /**
   * name
   */

  public close() {
    this.dialog = false;
  }
}
</script>
