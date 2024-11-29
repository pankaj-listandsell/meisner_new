export default  {

    methods: {

        download(url) {
            let element = document.createElement('a');
            element.setAttribute('href', url);

            element.style.display = 'none';
            document.body.appendChild(element);

            element.click();

            document.body.removeChild(element);
        },

    },

};
