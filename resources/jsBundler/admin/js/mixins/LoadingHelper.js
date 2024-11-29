export default  {
	methods: {

		openOverlayLoader(loaderContainer) {
			this.loader = this.$loading.show({container: loaderContainer});
		},

		closeOverlayLoader() {
			this.loader.hide();
		},

	}


};