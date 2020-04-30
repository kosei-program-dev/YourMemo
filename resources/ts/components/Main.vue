<template>
    <v-app id="inspire">
        <v-navigation-drawer app clipped>
            <v-list dense>
                <v-list-item>
                    <v-list-item-action>
                        <v-icon>mdi-folder-information-outline</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            <router-link class="black--text" to="/about"
                                >about</router-link
                            >
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app clipped-left color="blue darken-3 white--text">
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title
                >Europa - Carnage Heart EXA Uploader -</v-toolbar-title
            >
            <v-spacer></v-spacer>

            <v-toolbar-title>Login As:</v-toolbar-title>
        </v-app-bar>

        <router-view></router-view>

        <v-footer app clipped-center color="blue darken-3 white--text">
            <span>&copy; Kosei's Project</span>
        </v-footer>
    </v-app>
</template>

<script lang="ts">
import { Vue, Component, Prop } from "vue-property-decorator";
@Component
export default class App extends Vue {
    drawer: boolean = false;

    // @Prop()
    //   auth!: AuthUserObject | null;
    @Prop({ default: null })
    flash!: string | null;
}
</script>
