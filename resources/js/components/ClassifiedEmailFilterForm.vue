<script setup>
import { ref, computed, reactive } from "vue";
import axios from "axios";

const classified_words_phrases = ref("");
const email_text = ref("");

const classified_words_phrases_arr = computed(() => {
    return classified_words_phrases.value.split(",");
});

const is_classified = ref("");
const censored_text = ref("");

function submitForm() {
    axios
        .post("http://localhost:8000/api/filter-classified-email", {
            classified_words_phrases: classified_words_phrases_arr.value,
            email_text: email_text.value,
        })
        .then((res) => {
            console.log(res);
            is_classified.value = res.data.is_classified;
            censored_text.value = res.data.censored_text;
        })
        .catch((err) => {
            alert(err.response.data.message);
        });
}
</script>

<template>
    <div style="padding: 20px">
        <form class="max-w-md mx-auto" @submit.prevent="submitForm">
            <div style="margin-bottom: 15px">
                <label for="classified_words_phrases"
                    >List of classified words or phrases (Comma
                    separated)</label
                >
                <div>
                    <input
                        style="
                            border: 1px solid #aeaeae;
                            padding: 5px 10px;
                            width: 500px;
                        "
                        type="text"
                        v-model="classified_words_phrases"
                    />
                </div>
            </div>

            <div style="margin-bottom: 15px">
                <label for="email_text">Email body</label>
                <div>
                    <textarea
                        style="
                            border: 1px solid #aeaeae;
                            padding: 5px 10px;
                            height: 200px;
                            width: 500px;
                        "
                        v-model="email_text"
                    />
                </div>
            </div>

            <button
                style="
                    background-color: lightgreen;
                    padding: 5px 10px;
                    border-radius: 4px;
                "
                @click.prevent="submitForm"
            >
                SEND
            </button>
        </form>

        <div v-if="censored_text" style="margin-top: 20px">
            <h2>RESULTS:</h2>

            <div style="margin-bottom: 10px">
                Classified words and text detected: {{ is_classified }}
            </div>
            <div>
                <p>Censord text:</p>
                {{ censored_text }}
            </div>
        </div>
    </div>
</template>
