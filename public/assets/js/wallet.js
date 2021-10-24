class WalletActions {

    constructor() {
        this.initEvents();

    }

    initEvents() {
        this.initOnClickEvents();
    }

    initOnClickEvents() {
        var self = this;
        document.addEventListener('click', function (event) {
            if (event.target.matches('.delete-wallet')) {
                // Don't follow the link
                event.preventDefault();
                let route = event.target.dataset.route;
                self.deleteWallet(route);
            }
            console.log(event.target);

        }, false);
    }

    deleteWallet(route) {
        let xhr = new XMLHttpRequest();
        xhr.open('DELETE', route);
        xhr.send();
    }
}

walletActions = new WalletActions();