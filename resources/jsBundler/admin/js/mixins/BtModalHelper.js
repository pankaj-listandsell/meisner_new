export default (autoMode = 1) => {
    return {
        data() {
            return {
                autoHandle: autoMode
            }
        },

        created() {
            if (this.autoHandle) {
                this.openBtModal();
            }
        },

        beforeDestroy() {
            if (this.autoHandle) {
                this.closeBtModal();
            }

        },

        methods: {

            openBtModal() {
                let body = document.getElementsByTagName('body');
                body[0].classList.add('modal-open');
            },

            closeBtModal() {
                let body = document.getElementsByTagName('body');
                body[0].classList.remove('modal-open');
            }

        }
    }


};