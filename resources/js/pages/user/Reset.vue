<template>
    <div class="container--small">
        <h2>password reset</h2>

        <div class="panel">
            <!-- @submitで login method を呼び出し -->
            <!-- @submitイベントリスナに reset をつけるとsubmitイベントによってページがリロードさない -->
            <form class="form" @submit.prevent="reset">
                <!-- errors -->
                <div v-if="resetErrors" class="errors">
                    <ul v-if="resetErrors.password">
                        <li v-for="msg in resetErrors.password" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                    <ul v-if="resetErrors.token">
                        <li v-for="msg in resetErrors.token" :key="msg">
                            {{ msg }}
                        </li>
                    </ul>
                </div>
                <!--/ errors -->

                <div>
                    <input type="password" v-model="resetForm.password" />
                </div>
                <div>
                    <input
                        type="password"
                        v-model="resetForm.password_confirmation"
                    />
                </div>
                <div>
                    <button type="submit">reset</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Cookies from "js-cookie";

export default {
    // vueで使うデータ
    data() {
        return {
            resetForm: {
                password: "",
                password_confirmation: "",
                token: ""
            }
        };
    },
    computed: {
        // authストアのapiStatus
        apiStatus() {
            return this.$store.state.auth.apiStatus;
        },
        // authストアのresetErrorMessages
        resetErrors() {
            return this.$store.state.auth.resetErrorMessages;
        }
    },
    methods: {
        /*
         * reset
         */
        async reset() {
            // authストアのresetアクションを呼び出す
            await this.$store.dispatch("auth/userReset", this.resetForm);
            // 通信成功
            if (this.apiStatus) {
                // メッセージストアで表示
                this.$store.commit("message/setContent", {
                    content: "パスワードをリセットしました。",
                    timeout: 10000
                });
                // AUTHストアのエラーメッセージをクリア
                this.clearError();
                // フォームをクリア
                this.clearForm();
                // トップページに移動
                this.$router.push("/");
            }
        },

        /*
         * clear error messages
         */
        clearError() {
            // AUTHストアのエラーメッセージをクリア
            this.$store.commit("auth/setResetErrorMessages", null);
        },

        /*
         * clear reset Form
         */
        clearForm() {
            // reset
            this.resetForm.password = "";
            this.resetForm.password_confirmation = "";
            this.resetForm.token = "";
        }
    }
};
</script>
