<template>
  <v-content>
    <v-container>
      <v-layout row class="text-xs-center">
        <v-flex class="grey lighten-4">
          <v-container style class="text-xs-center">
            <v-card flat>
              <v-card-title primary-title>
                <h4>Register</h4>
              </v-card-title>
              <ValidationObserver ref="observer">
                <v-form method="POST" action="/register" id="register">
                  <input type="hidden" name="_token" :value="csrf" />

                  <v-col cols="12" md="12">
                    <ValidationProvider v-slot="{ errors }" name="名前" rules="required|max:100">
                      <v-text-field
                        prepend-icon="mdi-account-circle"
                        v-model="name"
                        name="name"
                        :counter="100"
                        :error-messages="errors"
                        label="名前"
                        required
                      ></v-text-field>
                    </ValidationProvider>
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="メールアドレス"
                      rules="required|max:100|email"
                    >
                      <v-text-field
                        prepend-icon="mdi-email"
                        v-model="email"
                        name="email"
                        :counter="100"
                        :error-messages="errors"
                        label="メールアドレス"
                        required
                      ></v-text-field>
                    </ValidationProvider>
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="パスワード"
                      rules="required|max:100|min:8|confirmed:password_confirmation"
                    >
                      <v-text-field
                        prepend-icon="mdi-lock"
                        v-model="password"
                        name="password"
                        :counter="100"
                        :error-messages="errors"
                        type="password"
                        label="パスワード"
                        required
                      ></v-text-field>
                    </ValidationProvider>
                    <ValidationProvider
                      v-slot="{ errors }"
                      name="パスワード再確認"
                      vid="password_confirmation"
                      rules="required|max:100|min:8"
                    >
                      <v-text-field
                        prepend-icon="mdi-lock"
                        v-model="password_confirmation"
                        :counter="100"
                        name="password_confirmation"
                        :error-messages="errors"
                        type="password"
                        label="パスワード再確認"
                        required
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-card-actions>
                    <v-btn primary large block class="primary" @click="registerConfirm()">登録する</v-btn>
                  </v-card-actions>
                </v-form>
              </ValidationObserver>
            </v-card>
          </v-container>
        </v-flex>
      </v-layout>
    </v-container>
    <register-confirm-modal ref="dialog" :registerObj="registerObj"></register-confirm-modal>
  </v-content>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
import { ValidationObserver } from "vee-validate";
import RegisterConfirmModal from "../modules/confirm/RegisterConfirmModal.vue";
import { RegisterObject } from "../../vue-data-entity/RegisterObject";

@Component({
  components: {
    RegisterConfirmModal
  }
})
export default class Register extends Vue {
  name: string = "";
  email: string = "";
  password: string = "";
  password_confirmation = "";
  registerObj: RegisterObject = {
    name: "",
    email: "",
    password: ""
  };
  csrf: string | null = document
    .querySelector('meta[name="csrf-token"]')!
    .getAttribute("content");

  $refs!: {
    observer: InstanceType<typeof ValidationObserver>;
    dialog: RegisterConfirmModal;
  };

  public async registerConfirm() {
    const isValid = await this.$refs.observer.validate();
    if (isValid) {
      this.registerObj.name = this.name;
      this.registerObj.email = this.email;
      this.registerObj.password = this.password;
      this.$refs.dialog.open();
      //   (<HTMLFormElement>document.querySelector("#register")).submit();
    }
  }
}
</script>
