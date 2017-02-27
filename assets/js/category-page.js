Number.prototype.formatMoney = function(c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))),
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

var vm = new Vue({
    el: "#app",
    data: {
        items: [],
        shop: [],
        showCart: false,
        verified: false,
        address: [],
        displayAddress: ""
    },
    mounted: function() {
        this.getUsers();
        this.fetchAddress();
    },
    ready: function() {
        this.getUsers();
        this.fetchAddress();

    },
    computed: {
        total() {
            var total = 0;
            for (var i = 0; i < this.shop.length; i++) {
                total += this.shop[i].subtotal;
            }
            return (total).formatMoney(2, '.', ',');
        }
    },
    methods: {
        fetchSelectedAddress(key) {
            console.log(key);
            // return $this.address.key;
        },
        fetchAddress: function() {
            var aecodeid_id = document.getElementById("aecodeid");
            if (aecodeid_id != null) {
                var aecodeid = document.getElementById("aecodeid").value;
            } else {
                var aecodeid = null;
            }
            if (aecodeid != null) {
                var link = '/address/api/list/' + aecodeid;
                this.$http.get(link).then(function(response) {
                    this.address = response.data;
                    console.log(response.data);
                }, function(error) {});
            }
        },
        getUsers: function() {
            var link = '/cart/set_item';
            this.$http.get(link).then(function(response) {
                this.shop = response.data;
            }, function(error) {});
        },
        addToCart(item, e) {
            var btn_cart = e.target;
            $(btn_cart).html('Sudah ditambah ke Keranjang');
            var link = '/cart/set_items/' + item;
            this.$http.get(link).then(function(response) {
                // this.shop.push(response.data);
                this.getUsers();
            }, function(error) {});
        },
        removeFromCart(item) {
            var link = '/cart/remove_item/' + item;
            this.$http.get(link).then(function(response) {
                // this.shop.push(response.data);
                this.getUsers();
            }, function(error) {

            });
        },
        fetchTips: function() {
            this.$http.get('/api/tips', function(tips) {
                this.$set('tips', tips)
            });
        }
    }
});