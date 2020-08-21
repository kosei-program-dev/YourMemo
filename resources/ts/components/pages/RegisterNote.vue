<template>
  <v-content>
    <v-container>
      <v-layout row class="text-xs-center">
        <v-flex class="grey lighten-4">
          <v-container style class="text-xs-center">
            <v-card flat>
              <v-card-title primary-title>
                <h4>メモの登録</h4>
              </v-card-title>
              <ValidationObserver ref="observer">
                <v-col cols="12" md="12">
                  <ValidationProvider v-slot="{ errors }" name="title" rules="required|max:100">
                    <v-text-field
                      prepend-icon="mdi-account-circle"
                      v-model="registerNoteObj.title"
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
                      v-model="registerNoteObj.comment"
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
                      v-model="registerNoteObj.url"
                      name="url"
                      :counter="1000"
                      :error-messages="errors"
                      label="url"
                      required
                    ></v-text-field>
                  </ValidationProvider>
                </v-col>
                <v-card-actions>
                  <v-btn primary large block class="primary" @click="registerNoteConfirm()">登録する</v-btn>
                </v-card-actions>
              </ValidationObserver>
            </v-card>
          </v-container>
        </v-flex>
      </v-layout>
    </v-container>
    <register-note-confirm-modal
      ref="dialog"
      @snackbar="openSnackbar"
      :registerNoteObj="registerNoteObj"
    ></register-note-confirm-modal>
    <v-snackbar v-model="snackbar" :timeout="timeout">{{ snackbarText }}</v-snackbar>
  </v-content>
</template>

<script lang="ts">
import { Vue, Component, Prop, Watch } from "vue-property-decorator";
import { ValidationObserver } from "vee-validate";
import RegisterNoteConfirmModal from "../modules/confirm/RegisterNoteConfirmModal.vue";
import { ConfirmNoteObject } from "../../vue-data-entity/ConfirmNoteObject";

@Component({
  components: {
    RegisterNoteConfirmModal,
  },
})
export default class RegisterNote extends Vue {
  @Prop()
  auth!: any;

  snackbar: boolean = false;
  snackbarText: string = "";
  timeout: number = 3000;

  registerNoteObj: ConfirmNoteObject = {
    title: "",
    comment: "",
    url: "",
  };

  $refs!: {
    observer: InstanceType<typeof ValidationObserver>;
    dialog: RegisterNoteConfirmModal;
  };

  public openSnackbar(snackbarText: string) {
    this.snackbarText = snackbarText;
    this.snackbar = true;
  }
  public async registerNoteConfirm() {
    const isValid = await this.$refs.observer.validate();
    if (isValid) {
      this.$refs.dialog.open();
    }
  }
}
</script>
