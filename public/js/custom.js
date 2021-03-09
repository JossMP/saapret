/** Ajax: Autocompletado **/
function SearchPerson() {
    return {
        person: {},
        doc_num: "",
        doc_type: "dni",
        isLoading: false,
        isSuccess: false,
        message: '',
        fetchPerson() {
            if (this.doc_num.length != 8) {
                this.isSuccess = false;
                this.message = 'Requerido'
            } else {
                // local
                this.person = JSON.parse(localStorage.getItem('D' + this.doc_num) || '[]')
                if (Object.keys(this.person).length > 0) {
                    this.isSuccess = true;
                    this.message = 'sucessfully'
                    localStorage.setItem('D' + this.doc_num, JSON.stringify(this.person))
                } else {
                    this.isLoading = true;
                    fetch('/person/reniec', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({ dni: this.doc_num })
                    }).then(res => res.json())
                        .then(data => {
                            this.person = data;

                            if (Object.keys(this.person).length > 0) {
                                this.isSuccess = true;
                                this.message = 'sucessfully'
                                localStorage.setItem('D' + this.doc_num, JSON.stringify(this.person))
                            }
                            else {
                                this.isSuccess = false;
                                this.message = 'Not found!'
                            }

                            console.log(this.message)
                        }).catch(() => {
                            this.person = {};
                            this.message = 'Ooops! Something went wrong!'
                            console.log(this.message)
                            this.isSuccess = false;
                        }).finally(() => {
                            this.isLoading = false;
                        })
                }
            }
        },
    };
}
