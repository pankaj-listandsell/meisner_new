export default {
    methods: {

        alertToast(description, title = '', type = 'success', isDescriptionArray = false, duration = 3000) {
            if (!isDescriptionArray) {
                this.$vToastify[type]({
                    body: description,
                    title: title,
                    type: type,
                    defaultTitle: false,
                    duration: duration,
                });
            } else {
                this.$vToastify[type]({
                    body: this.getArrayToHtml(description),
                    title: title,
                    type: type,
                    defaultTitle: false,
                    duration: duration,
                });
            }

        },

        confirmToast(description) {

            return this.$vToastify.prompt({
                body: description,
                answers: { Yes: true, No: false }
            });

        },

        getArrayToHtml(errors) {
            let html = "<ul class='m-t-15'>";
            for (let index in errors) {
                html += "<li class='m-b-10'>"  + errors[index][0] + "</li>";
            }
            html += "</ul>";
            return html;
        },

    }

}
